<?php

namespace App\Repositories\Transactions;

use App\Entities\DataTransferObjects\TransactionsData;
use App\Entities\DataTransferObjects\WalletData;
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
     * @param WalletData $walletSender
     * @param WalletData $walletReceiver
     * @param float $value
     * @return TransactionsData|null
     */
    public function createTransactionToWallets(
        WalletData $walletSender,
        WalletData $walletReceiver,
        float $value
    ): TransactionsData|null;

}
