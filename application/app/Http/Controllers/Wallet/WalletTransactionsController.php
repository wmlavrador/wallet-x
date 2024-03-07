<?php

namespace App\Http\Controllers\Wallet;

use App\Entities\DataTransferObjects\Transactions\TransactionsData;
use App\Exceptions\Transfer\TransferRulesException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\TransferBetweenWalletsRequest;
use App\UseCases\Wallet\TransferBetweenWalletsUseCase;
use Illuminate\Http\JsonResponse;

class WalletTransactionsController extends Controller
{
    public function __construct(
        protected readonly TransferBetweenWalletsUseCase $transferBetweenWalletsUseCase
    ) {
    }

    /**
     * @param TransferBetweenWalletsRequest $request
     * @return JsonResponse
     * @throws TransferRulesException
     */
    public function newTransaction(TransferBetweenWalletsRequest $request): JsonResponse
    {
        $transactionData = new TransactionsData(
            walletIdSender: $request->getSender(),
            walletIdReceiver: $request->getReceiver(),
            value: $request->getValue()
        );

        $transaction = $this->transferBetweenWalletsUseCase->createTransaction($transactionData);

        return response()->json([
            'success' => true,
            'transactionDetails' => $transaction,
            'message' => 'Transaction received with successfully to proccesment'
        ]);
    }
}
