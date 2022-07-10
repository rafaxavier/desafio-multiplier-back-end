<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemPedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pedido_id' => $this->faker->numberBetween(1, 400),
            'cardapio_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
