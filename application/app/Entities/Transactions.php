<?php

namespace App\Entities;

use Database\Factories\TransactionsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * @return BelongsTo
     */
    public function senderWallet(): BelongsTo
    {
        return $this->belongsTo(Wallets::class, 'wallets_id_sender', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function receiverWallet(): BelongsTo
    {
        return $this->belongsTo(Wallets::class, 'wallets_id_receiver', 'id');
    }
}
