<?php

namespace App\Entities\DataTransferObjects;

class WalletData
{
    public function __construct(
        public readonly int $userId,
        public readonly float $balance,
        public readonly string $type,
        public readonly ?int $id = null
    ) {}
}
