<?php

namespace App\Repositories\Wallets;

use App\Entities\DataTransferObjects\UserData;
use App\Entities\DataTransferObjects\WalletData;
use App\Entities\User;
use App\Entities\Wallets;
use Illuminate\Database\Eloquent\Collection;

interface WalletsRepositoryInterface
{
    /**
     * @param \App\Entities\DataTransferObjects\UserData $user
     * @param string|null $byWalletType
     * @return Wallets|null
     */
    public function getUserWallets(UserData $userData, string $byWalletType = null): Collection|null;

    /**
     * @param Wallets $wallet
     * @param float $value
     * @return bool|int
     */
    public function increaseBalanceOfWallet(Wallets $wallet, float $value): bool|int;

    /**
     * @param Wallets $wallet
     * @param float $value
     * @return bool|int
     */
    public function decreaseBalanceOfWallet(Wallets $wallet, float $value): bool|int;

    /**
     * @param User $user
     * @param WalletData $walletData
     * @return bool
     */
    public function createWalletToUser(User $user, WalletData $walletData): WalletData;
}
