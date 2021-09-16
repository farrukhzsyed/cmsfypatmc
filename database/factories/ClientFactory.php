<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hash;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'fname' => $this->faker->name($gender),
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $gender,
            'avatar' => 'profile image/'. $this->faker->image(public_path('profile image'),400,300, 'people', false), 
            'email_verified_at' => now(),
            'password' => Hash::make('CMS-Client'), // password
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}