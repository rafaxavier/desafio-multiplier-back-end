<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Cliente::factory()->count(10000)->create();
        \App\Models\Cardapio::factory()->count(50)->create();
        \App\Models\Pedido::factory()->count(400)->create();
        \App\Models\ItemPedido::factory()->count(800)->create();
    }
}
