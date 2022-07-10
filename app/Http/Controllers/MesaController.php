<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function __construct(Mesa $mesa)
    {
        $this->mesa = $mesa;
    }

    public function index()
    {
        $mesas = $this->mesa->all();
        return $mesas;
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required',
            'numero' => 'required|integer|unique:mesas',
        ], [
            //exibindo mensagens de erros de validação customizadas
            'numero.required' => 'Insira o numero da mesa',
            'numero.integer' => 'Insira somente números',
            'numero.unique'=>'Este numero de mesa já existe, tente outro numero',
        ]);

        $mesa = $this->mesa->create($request->all());
        return response()->json($mesa, 201);
    }

    public function show($id)
    {
        $result = $this->mesa->find($id);

        if ($result) {
            return response()->json($result, 200);
        }
        return response()->json(['msg' => 'not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $result = $this->mesa->find($id);
        if ($result) {
            $result->update($request->all());
            $result->save();

            return response()->json($result, 200);
        }

        return response()->json(['msg' => 'not found'], 404);
    }


    public function destroy($id)
    {
        $result = $this->mesa->find($id);
        if ($result) {
            $result->delete();

            return response()->json($result, 204);
        }

        return response()->json(['msg' => 'not found'], 404);
    }
}
