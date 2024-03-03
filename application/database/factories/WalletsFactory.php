<?php

namespace Database\Factories;

use App\Entities\User;
use App\Entities\Wallets;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class WalletsFactory extends Factory
{
    protected $model = Wallets::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'type' => $this->faker->randomElement(['fiat', 'crypto'])
        ];
    }
}
