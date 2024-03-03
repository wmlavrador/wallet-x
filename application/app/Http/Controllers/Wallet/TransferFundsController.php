<?php

namespace App\Http\Controllers\Wallet;

use App\Exceptions\Transfer\TransferRulesException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\TransferFundsRequest;
use App\UseCases\Wallet\TransferUseCase;
use Illuminate\Http\JsonResponse;

class TransferFundsController extends Controller
{
    protected TransferUseCase $transferUseCase;

    public function __construct(TransferUseCase $transferUseCase)
    {
        $this->transferUseCase = $transferUseCase;
    }

    /**
     * @param TransferFundsRequest $request
     * @return JsonResponse
     * @throws TransferRulesException
     */
    public function transferFunds(TransferFundsRequest $request): JsonResponse
    {
        $sender = $request->sender;
        $receiver = $request->receiver;
        $value = $request->value;

        $this->transferUseCase->transfer($sender, $receiver, $value);

        return response()->json([
            'status' => 1,
            'message' => 'Transaction received with successfully to proccesment'
        ]);
    }
}
