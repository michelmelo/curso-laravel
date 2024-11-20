<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->company(),
            'telefone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'ativo' => fake()->boolean(),
            'user_id' => User::factory(), // Relaciona com um usuário
        ];
    }
}
