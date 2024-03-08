<?php

namespace App\Repositories\Wallets;

use App\Entities\DataTransferObjects\User\UserData;
use App\Entities\DataTransferObjects\Wallet\WalletData;
use App\Entities\User;
use App\Entities\Wallets;
use Illuminate\Database\Eloquent\Collection;

class WalletsRepository implements WalletsRepositoryInterface
{

    public function specificWalletById(int $idWallet): WalletData|null
    {
        $wallet = Wallets::where('id', $idWallet)->first();

        return new WalletData(
            userId: $wallet->user_id,
            balance: $wallet->balance,
            type: $wallet->type,
            id: $wallet->id
        );
    }

    public function getUserWallets(UserData $userData, string $byWalletType = null): Collection|null
    {
        $userWallet = Wallets::where('user_id', $userData->id);

        if ($byWalletType) {
            return $userWallet->where('type', $byWalletType)->get();
        }

        return $userWallet->get();
    }

    public function increaseBalanceOfWallet(WalletData $wallet, float $value): bool|int
    {
        return Wallets::where('id', $wallet->id)->increment('balance', $value);
    }

    public function decreaseBalanceOfWallet(WalletData $wallet, float $value): bool|int
    {
        return Wallets::where('id', $wallet->id)->decrement('balance', $value);
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
