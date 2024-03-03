<?php

namespace Tests\Unit;

use App\Contracts\TransferFundsAuthorizerContract;
use App\Entities\User;
use App\Exceptions\Transfer\TransferRulesException;
use App\Gateways\TransferFundsAuthorizer\EFTAuthorizer\EFTAuthorizer;
use App\Repositories\User\UserRepository;
use App\UseCases\Wallet\TransferUseCase;
use PHPUnit\Framework\TestCase;

class TransferUseCaseTest extends TestCase
{
    protected TransferUseCase $transferUseCase;
    protected UserRepository $mockUserRepository;
    protected TransferFundsAuthorizerContract $mockTransferFundsAuthorizer;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockUserRepository = $this->createMock(UserRepository::class);
        $this->mockTransferFundsAuthorizer = $this->createMock(EFTAuthorizer::class);
        $this->user = $this->createMock(User::class);

        $this->transferUseCase = new TransferUseCase(
            $this->mockTransferFundsAuthorizer,
            $this->mockUserRepository
        );
    }

    public function testTransferWithInvalidValue(): void
    {
        $idSender = 1;
        $idReceiver = 2;
        $value = -100;

        $this->mockUserRepository->method('getUserById')
            ->willReturn($this->user);

        $this->mockTransferFundsAuthorizer->expects($this->never())
            ->method('checkTransferFunds');

        $this->expectException(TransferRulesException::class);

        $this->transferUseCase->transfer($idSender, $idReceiver, $value);
    }

}
