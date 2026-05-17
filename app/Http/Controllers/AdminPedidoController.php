<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class AdminPedidoController extends Controller
{
    private const ESTADOS = ['pendiente', 'enviado', 'entregado'];

    public function index(Request $request)
    {
        $query = Pedido::latest('fecha_pedido');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $pedidos = $query->paginate(20);

        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('lineas.producto');

        return view('admin.pedidos.show', [
            'pedido'  => $pedido,
            'estados' => self::ESTADOS,
        ]);
    }

    public function updateEstado(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => ['required', 'in:' . implode(',', self::ESTADOS)],
        ]);

        $pedido->update(['estado' => $request->estado]);

        return redirect()->route('admin.pedidos.show', $pedido)
            ->with('success', 'Estado actualizado a «' . $request->estado . '».');
    }
}
