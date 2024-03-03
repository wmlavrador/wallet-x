<?php

namespace App\Entities;

use Database\Factories\TransactionsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'wallets_id_sender',
        'wallets_id_receiver',
        'value',
    ];

    /**
     * @return TransactionsFactory
     */
    public static function factory(): TransactionsFactory
    {
        return TransactionsFactory::new();
    }
}
