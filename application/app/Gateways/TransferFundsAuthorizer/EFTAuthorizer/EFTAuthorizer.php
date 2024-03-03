<?php

namespace App\Gateways\TransferFundsAuthorizer\EFTAuthorizer;

use App\Contracts\TransferFundsAuthorizerContract;
use Illuminate\Support\Facades\Http;

class EFTAuthorizer implements TransferFundsAuthorizerContract
{
    private Http $client;
    private string $endpoint;

    public function __construct()
    {
        $this->client = new Http();
        $this->endpoint = env('ETFAUTHORIZER_ENDPOINT');
    }

    public function checkTransferFunds($sender, $receiver, $value): bool
    {
        $payload = $this->mountTransferPayload($sender, $receiver, $value);

        $response = $this->client::post(
            $this->endpoint,
            $payload
        );

        return $response->json('message') === CheckTransferFundsMessageEnumerator::AUTHORIZED;
    }

    private function mountTransferPayload($sender, $receiver, $value): array
    {
        return (new CheckTransferDTO())
            ->setPayer($sender->id)
            ->setPayee($receiver->id)
            ->setValue($value)
            ->mountPayload();
    }
}
