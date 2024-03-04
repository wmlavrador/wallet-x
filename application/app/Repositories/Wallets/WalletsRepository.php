<?php

namespace App\Repositories\Wallets;

use App\Entities\DataTransferObjects\UserData;
use App\Entities\DataTransferObjects\WalletData;
use App\Entities\User;
use App\Entities\Wallets;
use Illuminate\Database\Eloquent\Collection;

class WalletsRepository implements WalletsRepositoryInterface
{

    public function getUserWallets(UserData $userData, string $byWalletType = null): Collection|null
    {
        $userWallet = Wallets::where('user_id', $userData->id);

        if ($byWalletType) {
            return $userWallet->where('type', $byWalletType)->get();
        }

        return $userWallet->get();
    }

    public function increaseBalanceOfWallet(Wallets $wallet, float $value): bool|int
    {
        return $wallet->increment('balance', $value);
    }

    public function decreaseBalanceOfWallet(Wallets $wallet, float $value): bool|int
    {
        return $wallet->decrement('balance', $value);
    }

    public function createWalletToUser(User $user, WalletData $walletData): WalletData
    {
        $user->wallets()->create([
            'user_id' => $walletData->userId,
            'balance' => $walletData->balance,
            'type' => $walletData->type
        ]);

        return $walletData;
    }
}
