<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function __construct(Cardapio $cardapio)
    {
        $this->cardapio = $cardapio;
    }

    public function index()
    {
        $cardapios = $this->cardapio->all();
        return $cardapios;
    }


    public function store(Request $request)
    {
        $cardapio = $this->cardapio->create($request->all());
        return response()->json($cardapio, 201);
    }

    public function show($id)
    {
        $result = $this->cardapio->find($id);

        if ($result) {
            return response()->json($result, 200);
        }
        return response()->json(['msg' => 'not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $result = $this->cardapio->find($id);
        if ($result) {
            $result->update($request->all());
            $result->save();

            return response()->json($result, 200);
        }

        return response()->json(['msg' => 'not found'], 404);
    }

    public function destroy($id)
    {   
        $result = $this->cardapio->find($id);
        if ($result) {
            $result->delete();

            return response()->json($result, 204);
        }

        return response()->json(['msg' => 'not found'], 404);
    }
}
