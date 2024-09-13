<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    public function definition()
    {
        // Define the structure of your Wallet model for testing
        return [
            'user_id' => \App\Models\User::factory(),
            'credentials' => Crypt::encryptString(json_encode([
                ['url' => 'http://example.com', 'username' => $this->faker->userName, 'password' => $this->faker->password]
            ])),
            'status' => true,
        ];
    }
}
