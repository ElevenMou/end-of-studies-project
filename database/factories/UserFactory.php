<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'identifiant' => rand(1999999,19999999),
            'prenom' => $this->faker->firstName(),
            'nom' => $this->faker->lastName(),
            'filiere' => 'smi',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('12345678'),
            'type' => 0,
            'statu' => 1,
            'isModerator' => 0,
            'avatar' => 'images/avatars/default-avatar.jpg',
            'description' => '',
            'remember_token' => Str::random(10),
        ];
        /* return [
            'identifiant' => 1,
            'prenom' => 'moussa',
            'nom' => 'saidi',
            'filiere' => 'all',
            'email' => 'moussa.saidi@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 2,
            'statu' => 1,
            'isModerator' => 1,
            'avatar' => 'images/avatars/default-avatar.jpg',
            'description' => 'Official admin page',
            'remember_token' => Str::random(10),
        ]; */
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
