<?php

namespace App\Http\Controllers;

use App\Models\LineaPedido;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function checkout()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index');
        }

        $items    = array_values($carrito);
        $subtotal = collect($items)->sum(fn($i) => $i['precio'] * $i['cantidad']);
        $envio    = $subtotal < 40 ? 4.95 : 0;
        $total    = $subtotal + $envio;

        return view('pedido.checkout', compact('items', 'subtotal', 'envio', 'total'));
    }

    public function confirmar(Request $request)
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index');
        }

        $data = $request->validate([
            'nombre'      => ['required', 'string', 'max:60'],
            'apellidos'   => ['required', 'string', 'max:60'],
            'direccion'   => ['required', 'string', 'max:150'],
            'cp'          => ['required', 'digits:5'],
            'localidad'   => ['required', 'string', 'max:60'],
            'provincia'   => ['required', 'string', 'max:60'],
            'telefono'    => ['nullable', 'string', 'max:20'],
            'email'       => ['required', 'email', 'max:120'],
            'notas'       => ['nullable', 'string', 'max:255'],
            'metodo_pago' => ['required', 'in:transferencia,bizum'],
        ]);

        $items    = array_values($carrito);
        $subtotal = collect($items)->sum(fn($i) => $i['precio'] * $i['cantidad']);
        $envio    = $subtotal < 40 ? 4.95 : 0;
        $total    = $subtotal + $envio;

        $pedido = DB::transaction(function () use ($data, $items, $total) {
            $pedido = Pedido::create([
                'fecha_pedido'    => now()->toDateString(),
                'estado'          => 'pendiente',
                'precio_pedido'   => $total,
                'nombre_cliente'  => trim($data['nombre'] . ' ' . $data['apellidos']),
                'tlf_cliente'     => $data['telefono'] ?? null,
                'email_cliente'   => $data['email'],
                'direccion_envio' => trim("{$data['direccion']}, {$data['cp']} {$data['localidad']}, {$data['provincia']}"),
                'metodo_pago'     => $data['metodo_pago'],
            ]);

            foreach ($items as $item) {
                LineaPedido::create([
                    'pedido_id'       => $pedido->id,
                    'producto_id'     => $item['id'],
                    'cantidad'        => $item['cantidad'],
                    'formato'         => $item['formato'],
                    'precio_unitario' => $item['precio'],
                ]);
            }

            return $pedido;
        });

        session()->forget('carrito');

        return redirect()->route('pedido.confirmacion', $pedido->id);
    }
}
