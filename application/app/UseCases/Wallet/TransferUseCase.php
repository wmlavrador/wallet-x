<?php

namespace App\UseCases\Wallet;

use App\Contracts\TransferFundsAuthorizerContract;
use App\Entities\User;
use App\Exceptions\Transfer\TransferRulesException;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class TransferUseCase
{
    private TransferFundsAuthorizerContract $transferFundsAuthorizer;
    private UserRepository $userRepository;

    public function __construct(
        TransferFundsAuthorizerContract $transferFundsAuthorizer,
        UserRepositoryInterface $userRepository
    ) {
        $this->transferFundsAuthorizer = $transferFundsAuthorizer;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws TransferRulesException
     */
    public function transfer(int $idSender, int $idReceiver, float $value): void
    {
        $sender = $this->userRepository->getUserById($idSender);
        $receiver = $this->userRepository->getUserById($idReceiver);
        $this->rulesForTransfer($sender, $receiver, $value);

        $this->makeTransfer($sender, $receiver, $value);
    }

    private function makeTransfer(User $sender, User $receiver, float $value): void
    {
        // @TODO: dispatch a transaction job to process the values transfer
    }

    /**
     * @throws TransferRulesException
     */
    private function rulesForTransfer(User $sender, User $receiver, float $value): void
    {
        if ($sender->id === $receiver->id) {
            throw new TransferRulesException('Is not possible transfer funds to your self');
        }

        if ($value < 0) {
            throw new TransferRulesException('Please, input a positive value');
        }

        if (!$this->transferFundsAuthorizer->checkTransferFunds($sender, $receiver, $value)) {
            throw new TransferRulesException('This Transfer are not authorized');
        }
    }

}
