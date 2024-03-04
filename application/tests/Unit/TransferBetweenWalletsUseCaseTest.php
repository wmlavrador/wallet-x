<?php

namespace Tests\Unit\UseCases\Wallet;

use App\Contracts\TransferFundsAuthorizerContract;
use App\Entities\DataTransferObjects\TransactionsData;
use App\Entities\DataTransferObjects\WalletData;
use App\Entities\Wallets;
use App\Exceptions\Transfer\TransferRulesException;
use App\Gateways\TransferFundsAuthorizer\EFTAuthorizer\EFTAuthorizer;
use App\Repositories\Transactions\TransactionsRepository;
use App\Repositories\Transactions\TransactionsRepositoryInterface;
use App\Repositories\Wallets\WalletsRepository;
use App\Repositories\Wallets\WalletsRepositoryInterface;
use App\UseCases\Wallet\TransferBetweenWalletsUseCase;
use PHPUnit\Framework\TestCase;

class TransferBetweenWalletsUseCaseTest extends TestCase
{
    protected TransferBetweenWalletsUseCase $useCase;
    protected TransferFundsAuthorizerContract $transferFundsAuthorizer;
    protected TransactionsRepositoryInterface $transactionsRepository;
    protected WalletsRepositoryInterface $walletsRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->transferFundsAuthorizer = $this->createMock(EFTAuthorizer::class);
        $this->transactionsRepository = $this->createMock(TransactionsRepository::class);
        $this->walletsRepository = $this->createMock(WalletsRepository::class);

        $this->useCase = new TransferBetweenWalletsUseCase(
            $this->transferFundsAuthorizer,
            $this->transactionsRepository,
            $this->walletsRepository
        );
    }

    protected function configureWallets($senderBalance, $receiverBalance): void
    {
        $sender = new WalletData(1, $senderBalance, Wallets::WALLET_FIAT);
        $receiver = new WalletData(2, $receiverBalance, Wallets::WALLET_FIAT);

        $this->walletsRepository->method('specificWalletById')->willReturnMap([
            [1, $sender],
            [2, $receiver],
        ]);
    }

    public function testCreateTransactionWithInsufficientFunds(): void
    {
        $this->configureWallets(0, 100);

        $this->transferFundsAuthorizer->method('checkTransferFunds')->willReturn(true);

        $this->expectException(TransferRulesException::class);
        $this->useCase->createTransaction(new TransactionsData(1, 2, 150));
    }

    public function testCreateTransactionWithNotAuthorizedETF(): void
    {
        $this->configureWallets(0, 100);

        $this->transferFundsAuthorizer->method('checkTransferFunds')->willReturn(false);

        $this->expectException(TransferRulesException::class);
        $this->useCase->createTransaction(new TransactionsData(1, 2, 150));
    }
}
