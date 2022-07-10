<?php

namespace App\Repositories;

use App\Models\ItemPedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PedidoRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getPedidosStatusFazendo($user_id)
    {
        return $this->model->where('user_id', $user_id)->where('status', '=', 'fazendo')
            ->with('itens:id,pedido_id,cardapio_id')->get();
    }

    public function getPedidosAfazerEfazendo()
    {
        return $this->model->where('status', '<>', 'feito')->with('itens:id,pedido_id,cardapio_id')->get();
    }

    public function getPedidosPorDia($dia)
    {
        return $this->model->whereDay('created_at', $dia)->with('itens:id,pedido_id,cardapio_id')->get();
    }

    public function getPedidosPorMes($mes)
    {
        return $this->model->whereMonth('created_at', $mes)->with('itens:id,pedido_id,cardapio_id')->get();
    }

    public function getPedidosPorMesa($mesa_id)
    {
        return $this->model->where('mesa_id', $mesa_id)->with('itens:id,pedido_id,cardapio_id')->get();
    }

    public function getPedidosPorCliente($cliente_id)
    {
        return $this->model->where('cliente_id', $cliente_id)->with('itens:id,pedido_id,cardapio_id')->get();
    }

    public function getPedidosPorSemana()
    {
        $now = Carbon::now();
        $startWeek = $now->startOfWeek()->format('Y-m-d');
        $endWeek = $now->endOfWeek()->format('Y-m-d');

        return $this->model->whereBetween('created_at', [$startWeek, $endWeek])
            ->with('itens:id,pedido_id,cardapio_id')->get();
    }

    public function salvandoPedido($request)
    {
        $request->validate([
            // 'user_id' => 'required',
            'mesa_id' => 'required|integer',
            'cliente_id' => 'required|integer',
        ], [
            //exibindo mensagens de erros de validação customizadas
            'mesa_id.required' => 'Insira o id da mesa',
            'mesa_id.integer' => 'Insira somente números',
            'cliente_id.required' => 'Insira o id do cliente',
            'cliente_id.integer' => 'Insira somente números',
        ]);

        // iniciando a transação do banco de dados
        DB::beginTransaction();
        // salvando o pedido
        $pedido = $this->model;
        $pedido->mesa_id = $request->mesa_id;
        $pedido->cliente_id = $request->cliente_id;
        $pedido->user_id = auth()->user()->id;
        $pedido->save();

        // salvando os itens pedido
        for ($i = 1; $i <= count($request->all()) - 2; $i++) {
            // attrb a var,  'itemId' concacatenada aos num da iteração exemplo 'itemId1', 'itemId2'.....
            $item = 'item' . $i;

            // salvando item pedidos no BD
            $itemPedido = new ItemPedido();
            $itemPedido->pedido_id = $pedido->id;
            $itemPedido->cardapio_id = $request->$item;

            // armazenando no banco
            $itemPedido->save();
        };

        //comitar o salvamento do pedido no BD
        DB::commit();

        return $pedido;
    }
}
