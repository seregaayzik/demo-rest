<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone_number' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('qwerty12345'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()->count(10)->create(['user_id' => $user->id]);
        });
    }
}
