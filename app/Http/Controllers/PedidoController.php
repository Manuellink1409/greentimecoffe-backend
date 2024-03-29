<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\PedidoProducto;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pedido = new Pedido();
        $pedido->user_id = Auth::user()->id;
        $pedido->total= $request->total;
        $pedido->save();

        $id=$pedido->id;
        $productos = $request->productos;
        $pedido_productos = [];

        foreach ($productos as $producto) {
            $pedido_productos[] = [
                "pedido_id" => $id,
                "producto_id" => $producto["id"],
                "cantidad" => $producto["cantidad"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
        }

        PedidoProducto::insert($pedido_productos);

        return ["message"=> "Pedido realizado, estará listo en unos minutos"];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
