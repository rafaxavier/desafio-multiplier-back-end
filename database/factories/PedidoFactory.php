<?php

namespace Database\Factories;

use DateTime;

use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mesa_id' => $this->faker->numberBetween(1, 4),
            'user_id' => $this->faker->numberBetween(3, 4),
            'cliente_id' => $this->faker->numberBetween(1, 10000),
            'status' => $this->faker->randomElement(['fazer', 'fazendo', 'feito']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '+1 week','America/Sao_Paulo'),
        ];



    }
}
