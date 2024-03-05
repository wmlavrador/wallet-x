<?php

namespace Database\Factories;

use App\Entities\Transactions;
use App\Entities\Wallets;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transactions>
 */
class TransactionsFactory extends Factory
{
    protected $model = Transactions::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senderWallet = Wallets::inRandomOrder()->first();
        $receiverWallet = Wallets::where('id', '!=', $senderWallet->id)->inRandomOrder()->first();

        return [
            'code' => $this->faker->uuid,
            'wallets_id_sender' => $senderWallet->id,
            'wallets_id_receiver' => $receiverWallet->id,
            'value' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
