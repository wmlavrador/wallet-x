<?php

namespace App\Gateways\TransferFundsAuthorizer\EFTAuthorizer;

use App\Contracts\TransferFundsAuthorizerContract;
use App\Entities\DataTransferObjects\WalletData;
use Illuminate\Support\Facades\Http;

class EFTAuthorizer implements TransferFundsAuthorizerContract
{
    private readonly string $endpoint;

    public function __construct(
        private readonly Http $client = new Http()
    ) {
        $this->endpoint = env('ETFAUTHORIZER_ENDPOINT');
    }

    public function checkTransferFunds(WalletData $sender, WalletData $receiver, $value): bool
    {
        $payload = $this->mountTransferPayload($sender, $receiver, $value);
        $response = $this->client::post(
            $this->endpoint,
            $payload
        );

        return $response->json('message') === CheckTransferFundsMessageEnumerator::Authorized->value;
    }

    private function mountTransferPayload($sender, $receiver, $value): array
    {
        return (new CheckTransferData(
            payer: $sender->id,
            payee: $receiver->id,
            value: $value
        ))->toArray();
    }
}
