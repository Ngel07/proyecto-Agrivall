<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);

        $subtotal = collect($carrito)->sum(fn($i) => $i['precio'] * $i['cantidad']);
        $envio    = $subtotal > 0 && $subtotal < 40 ? 4.95 : 0;
        $total    = $subtotal + $envio;

        return view('carrito.index', [
            'items'    => array_values($carrito),
            'subtotal' => $subtotal,
            'envio'    => $envio,
            'total'    => $total,
        ]);
    }

    public function añadir(Producto $producto)
    {
        $carrito = session('carrito', []);
        $id      = $producto->id;

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = min($carrito[$id]['cantidad'] + 1, 99);
        } else {
            $carrito[$id] = [
                'id'       => $producto->id,
                'nombre'   => $producto->nombre,
                'variedad' => $producto->variedad,
                'formato'  => $producto->formato,
                'precio'   => (float) $producto->precio,
                'cantidad' => 1,
                'imagen'   => $producto->imagen ?? 'images/cereza-default.png',
            ];
        }

        session(['carrito' => $carrito]);

        return back()->with('carrito_ok', '«' . $producto->nombre . '» añadido al carrito.');
    }

    public function actualizar(Request $request, int $productoId)
    {
        $cantidad = (int) $request->input('cantidad', 1);
        $carrito  = session('carrito', []);

        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] = max(1, min($cantidad, 99));
            session(['carrito' => $carrito]);
        }

        return back();
    }

    public function eliminar(int $productoId)
    {
        $carrito = session('carrito', []);
        unset($carrito[$productoId]);
        session(['carrito' => $carrito]);

        return back();
    }

    public function vaciar()
    {
        session()->forget('carrito');

        return back();
    }
}
