<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Repositories\PedidoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PedidoController extends Controller
{
    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
        $this->repo = new PedidoRepository($this->pedido);
    }

    public function index(Request $request)
    {
        $user = auth()->user();


        if (Gate::allows('garcom')) {
            $pedidos = $this->repo->getPedidosStatusFazendo($user->id);
            return $pedidos;
        }

        if (Gate::allows('cozinheiro')) {
            $pedidos = $this->repo->getPedidosAfazerEfazendo();
            return $pedidos;
        }

        if (Gate::allows('admin')) {
            $params = $request->all();
            // extraindo a chave do parametro
            $key = key($params);
            // extraindo o valor do parametro
            $valor = $params[$key];
            // concatencao da chave recebida pelo param completando o nome da funcao
            $func = "getPedidosPor" . ucwords($key);

            $pedidos = $this->repo->$func($valor);

            return $pedidos;
        }

        return response()->json(['msg' => 'recurso não autorizado!'], 403);
    }

    public function store(Request $request)
    {
        if (Gate::allows('garcom')) {
            $pedido = $this->repo->salvandoPedido($request);

            return response()->json($pedido, 201);
        }

        return response()->json(['msg' => 'recurso não autorizado!'], 403);
    }

    public function show($id)
    {
        $result = $this->pedido->with('itens')->find($id);

        if ($result) {
            return response()->json($result, 200);
        }
        return response()->json(['msg' => 'not found'], 404);
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('cozinheiro')) {
            $result = $this->pedido->find($id);
            if ($result) {
                $result->status = $request->status;
                $result->save();

                return response()->json($result, 200);
            }

            return response()->json(['msg' => 'not found'], 404);
        }
        return response()->json(['msg' => 'recurso não autorizado!'], 403);
    }

    public function destroy($id)
    {
        $result = $this->pedido->find($id);
        if ($result) {
            $result->delete();

            return response()->json($result, 204);
        }

        return response()->json(['msg' => 'not found'], 404);
    }
}
