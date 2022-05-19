<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->word(),
            'secondName' => $this->faker->word(),
            'surname' => $this->faker->word(),
            'secondSurname' => $this->faker->word(),
            'documentType' => $this->faker->randomElement(['Cedula de ciudadanía', 'Cedula de extranjería', 'Tarjeta de identidad', 'Pasaporte']),
            'documentNumber' => $this->faker->randomNumber(9, true),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$YhrAYil9C9YkFZ8DqDDThep8vEH6YfDLRmG3skyYRgLq.p5IG/aM.', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
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
