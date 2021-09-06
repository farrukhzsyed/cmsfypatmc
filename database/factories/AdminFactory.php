<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use File;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        File::makeDirectory(public_path('profile image'), 0777, true, true);
        return [
            'name' => $this->faker->name,
            'avatar' => 'profile image/'. $this->faker->image(public_path('profile image'),400,300, 'people', false), 
            'email' => 'admin@cms.com',
            // 'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}