<?php

namespace App\Repositories\Wallets;

use App\Entities\DataTransferObjects\User\UserData;
use App\Entities\DataTransferObjects\Wallet\WalletData;
use App\Entities\User;
use App\Entities\Wallets;
use Illuminate\Database\Eloquent\Collection;

interface WalletsRepositoryInterface
{
    /**
     * @param int $idWallet
     * @return WalletData|null
     */
    public function specificWalletById(int $idWallet): WalletData|null;

    /**
     * @param UserData $userData
     * @param string|null $byWalletType
     * @return Wallets|null
     */
    public function getUserWallets(UserData $userData, string $byWalletType = null): Collection|null;

    /**
     * @param WalletData $wallet
     * @param float $value
     * @return bool|int
     */
    public function increaseBalanceOfWallet(WalletData $wallet, float $value): bool|int;

    /**
     * @param WalletData $wallet
     * @param float $value
     * @return bool|int
     */
    public function decreaseBalanceOfWallet(WalletData $wallet, float $value): bool|int;

    /**
     * @param User $user
     * @param WalletData $walletData
     * @return bool
     */
    public function createWalletToUser(User $user, WalletData $walletData): WalletData;
}
