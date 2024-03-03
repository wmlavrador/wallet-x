<?php

namespace App\Contracts;

use App\Entities\User;

interface TransferFundsAuthorizerContract
{

    /**
     * @param User $sender
     * @param User $receiver
     * @param float $value
     * @return bool
     */
    public function checkTransferFunds(User $sender, User $receiver, float $value): bool;
}
