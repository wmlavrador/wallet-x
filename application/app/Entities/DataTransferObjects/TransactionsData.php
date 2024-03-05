<?php

namespace App\Entities\DataTransferObjects;

class TransactionsData
{
    public function __construct(
        public readonly int     $walletIdSender,
        public readonly int     $walletIdReceiver,
        public readonly float   $value,
        public readonly ?int    $id = null,
        public readonly ?string $code = null
    ) {}
}
