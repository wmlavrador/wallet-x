<?php

namespace App\Repositories\Transactions;

use App\Entities\DataTransferObjects\TransactionsData;
use App\Entities\DataTransferObjects\WalletData;
use App\Entities\Transactions;
use App\Entities\Wallets;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class TransactionsRepository implements TransactionsRepositoryInterface
{
    public function getAllWalletReceiverTransactions(WalletData $walletData): Collection
    {
        return Wallets::where('id', $walletData->id)
            ->first()
            ->receiverTransactions()
            ->get();
    }

    public function getAllWalletSenderTransactions(WalletData $walletData): Collection
    {
        return Wallets::where('id', $walletData->id)
            ->first()
            ->senderTransactions()
            ->get();
    }

    public function createTransactionToWallets(TransactionsData $transactionData): TransactionsData|null
    {
        $newTransaction = Transactions::create([
            'code' => Uuid::uuid4()->toString(),
            'wallets_id_sender' => $transactionData->walletIdSender,
            'wallets_id_receiver' => $transactionData->walletIdReceiver,
            'value' => $transactionData->value
        ]);

        return new TransactionsData(
            walletIdSender: $newTransaction->wallets_id_sender,
            walletIdReceiver: $newTransaction->wallets_id_receiver,
            value: $newTransaction->value,
            id: $newTransaction->id,
            code: $newTransaction->code
        );
    }
}
