<?php

namespace app\Gateways\TransferFundsAuthorizer\EFTAuthorizer;

class CheckTransferData
{
    public function __construct(
        private readonly int $payer,
        private readonly int $payee,
        private readonly float $value
    ){}

    public function toArray(): array
    {
        return [
            $this->payer,
            $this->payee,
            $this->value
        ];
    }

}
