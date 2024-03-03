<?php

namespace app\Gateways\TransferFundsAuthorizer\EFTAuthorizer;

enum CheckTransferFundsMessageEnumerator
{
    public const AUTHORIZED = 'Autorizado';
    public const NOT_AUTHORIZED = 'Não Authorizado';
}
