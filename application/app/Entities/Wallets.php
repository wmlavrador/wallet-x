<?php

namespace App\Entities;

use Database\Factories\WalletsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallets extends Model
{
    use HasFactory;

    public const WALLET_FIAT = 1;
    public const WALLET_CRYPTO = 2;

    public const WALLET_TYPE_LABEL = [
        self::WALLET_FIAT => 'Fiat',
        self::WALLET_CRYPTO => 'Crypto'
    ];

    public static function getWalletTypeLabel(int $type): string
    {
        return self::WALLET_TYPE_LABEL[$type] ?? 'Status is not defined';
    }

    protected $fillable = [
        'user_id',
        'balance',
        'type',
    ];

    /**
     * @return WalletsFactory
     */
    public static function factory(): WalletsFactory
    {
        return WalletsFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function senderTransactions(): HasMany
    {
        return $this->hasMany(Transactions::class, 'wallets_id_sender', 'id');
    }

    /**
     * @return HasMany
     */
    public function receiverTransactions(): HasMany
    {
        return $this->hasMany(Transactions::class, 'wallets_id_receiver', 'id');
    }
}
