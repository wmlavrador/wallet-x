<?php

namespace App\Entities\DataTransferObjects\User;

class UserPersonalTokenData
{
    public function __construct(
        public readonly string $personalToken,
        public readonly ?\DateTimeInterface $expiresAt = null,
        public readonly ?\DateTimeInterface $lastUsedAt = null,
        public readonly ?string $name = null,
        public readonly ?array $abilities = null
    ){}
}
