<?php

namespace app\Gateways\TransferFundsAuthorizer\EFTAuthorizer;

class CheckTransferDTO
{
    public int $payer;
    public int $payee;
    public int $value;

    public function setPayer(int $payer): self
    {
        $this->payer = $payer;
        return $this;
    }

    public function getPayer(): int
    {
        return $this->payer;
    }

    public function setPayee(int $payee): self
    {
        $this->payee = $payee;
        return $this;
    }

    public function getPayee(): int
    {
        return $this->payee;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function mountPayload(): array
    {
        return [
            'payer' => $this->payer,
            'payee' => $this->payee,
            'value' => $this->value
        ];
    }
}
