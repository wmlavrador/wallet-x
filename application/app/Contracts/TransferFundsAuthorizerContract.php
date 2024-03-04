<?php

namespace App\Contracts;

use App\Entities\DataTransferObjects\WalletData;

interface TransferFundsAuthorizerContract
{

    /**
     * @param WalletData $sender
     * @param WalletData $receiver
     * @param float $value
     * @return bool
     */
    public function checkTransferFunds(WalletData $sender, WalletData $receiver, float $value): bool;
}
