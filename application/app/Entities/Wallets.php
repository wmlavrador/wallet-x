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

    public const WalletTypeFiat = 'fiat';
    public const WalletTypeCrypto = 'crypto';

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
