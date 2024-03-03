<?php

namespace app\Gateways\TransferFundsAuthorizer\EFTAuthorizer;

enum CheckTransferFundsMessageEnumerator: string
{
    case Authorized = 'Autorizado';
    case NotAuthorized = 'Não Autorizado';
}
