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

    public const STATUS_PROCCESSING = 1;
    public const STATUS_APPROVED = 2;
    public const STATUS_REVERTED = 3;

    public const STATUS_LABEL = [
        self::STATUS_PROCCESSING => 'Proccessing',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_REVERTED => 'Reverted'
    ];

    public static function getStatusLabel(int $status): string
    {
        return self::STATUS_LABEL[$status] ?? 'Status is not defined';
    }

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
