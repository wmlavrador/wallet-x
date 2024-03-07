<?php

namespace App\Entities\DataTransferObjects\User;

class UserData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password = null,
        public readonly ?int $id = null
    ){}
}
