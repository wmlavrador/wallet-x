<?php

namespace App\UseCases\Wallet;

use App\Contracts\TransferFundsAuthorizerContract;
use App\Entities\DataTransferObjects\Transactions\TransactionsData;
use App\Entities\DataTransferObjects\Wallet\WalletData;
use App\Exceptions\Transfer\TransferRulesException;
use App\Repositories\Transactions\TransactionsRepositoryInterface;
use App\Repositories\Wallets\WalletsRepositoryInterface;

class TransferBetweenWalletsUseCase
{

    public function __construct(
        private readonly TransferFundsAuthorizerContract $transferFundsAuthorizer,
        private readonly TransactionsRepositoryInterface $transactionsRepository,
        private readonly WalletsRepositoryInterface $walletsRepository
    ) {
    }


    /**
     * @param TransactionsData $transactionData
     * @return TransactionsData
     * @throws TransferRulesException
     */
    public function createTransaction(TransactionsData $transactionData): TransactionsData
    {
        $walletSender = $this->walletsRepository->specificWalletById($transactionData->walletIdSender);
        $walletReceiver = $this->walletsRepository->specificWalletById($transactionData->walletIdReceiver);
        $value = $transactionData->value;

        $this->rulesForTransferFunds($walletSender, $walletReceiver, $value);

        return $this->makeTransfer($walletSender, $walletReceiver, $transactionData);
    }

    /**
     * @param WalletData $sender
     * @param WalletData $receiver
     * @param TransactionsData $transactionsData
     * @return TransactionsData
     */
    private function makeTransfer(
        WalletData $sender,
        WalletData $receiver,
        TransactionsData $transactionsData
    ): TransactionsData {
        $this->walletsRepository->decreaseBalanceOfWallet($sender, $transactionsData->value);
        $this->walletsRepository->increaseBalanceOfWallet($receiver, $transactionsData->value);

        return $this->transactionsRepository->createTransactionToWallets(
            $transactionsData
        );
    }

    /**
     * @param WalletData $sender
     * @param WalletData $receiver
     * @param float $value
     * @return void
     * @throws TransferRulesException
     */
    private function rulesForTransferFunds(WalletData $sender, WalletData $receiver, float $value): void
    {
        if ($sender->balance < $value) {
            throw new TransferRulesException('You have no suficient funds to complete the transfer');
        }

        if ($sender->userId === $receiver->userId) {
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
