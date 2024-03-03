<?php

namespace App\Entities;

use Database\Factories\WalletsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;

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
}
