<?php

namespace App\Repositories\Transactions;

use App\Entities\DataTransferObjects\Transactions\TransactionsData;
use App\Entities\DataTransferObjects\Wallet\WalletData;
use Illuminate\Database\Eloquent\Collection;

interface TransactionsRepositoryInterface
{
    /**
     * @param WalletData $walletData
     * @return Collection
     */
    public function getAllWalletReceiverTransactions(WalletData $walletData): Collection;

    /**
     * @param WalletData $walletData
     * @return Collection
     */
    public function getAllWalletSenderTransactions(WalletData $walletData): Collection;

    /**
     * @param TransactionsData $transactionData
     * @return TransactionsData|null
     */
    public function createTransactionToWallets(TransactionsData $transactionData): TransactionsData|null;

}
