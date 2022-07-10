<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemPedido;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['mesa_id', 'user_id'];


    /**
     * Obtenha os items associado ao pedido.
     */
    public function itens()
    {
        return $this->hasMany(ItemPedido::class, 'pedido_id');
    }
}
