<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransferBetweenWalletsRequest extends FormRequest
{
    public function getSender(): int
    {
        return $this->sender;
    }

    public function getReceiver(): int
    {
        return $this->receiver;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sender' => 'required|integer|exists:wallets,id',
            'receiver' => 'required|integer|exists:wallets,id',
            'value' => 'required|numeric'
        ];
    }
}
