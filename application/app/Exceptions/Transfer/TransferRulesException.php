<?php

namespace App\Exceptions\Transfer;

use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TransferRulesException extends Exception
{
    public function render(): Response
    {
        return response([
            'error' => $this->message
        ], $this->code === 0 ? ResponseAlias::HTTP_UNPROCESSABLE_ENTITY : $this->code );
    }
}
