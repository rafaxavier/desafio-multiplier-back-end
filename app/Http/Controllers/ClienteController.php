<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index()
    {
        $clientes = $this->cliente->all();
        return $clientes;
    }

    public function store(Request $request)
    {   
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|integer|unique:clientes',
        ], [
            //exibindo mensagens de erros de validação customizadas
            'nome.required' => 'Insira o nome do cliente',
            'cpf.required' => 'Insira o cpf do cliente',
            'cpf.integer' => 'Insira somente números',
            'cpf.unique'=>'Este cpf de mesa já existe, tente outro cpf',
        ]);

        $cliente = $this->cliente->create($request->all());
        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        $result = $this->cliente->find($id);

        if ($result) {
            return response()->json($result, 200);
        }
        return response()->json(['msg' => 'not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $result = $this->cliente->find($id);
        if ($result) {
            $result->update($request->all());
            $result->save();

            return response()->json($result, 200);
        }

        return response()->json(['msg' => 'not found'], 404);
    }

    
    public function destroy($id)
    {
        $result = $this->cliente->find($id);
        if ($result) {
            $result->delete();

            return response()->json($result, 204);
        }

        return response()->json(['msg' => 'not found'], 404);
    }
}
