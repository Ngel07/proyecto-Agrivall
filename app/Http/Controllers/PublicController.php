<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function productos(Request $request): View
    {
        $query = Producto::where('disponible', true);

        if ($request->filled('categoria')) {
            $query->where('nombre', $request->categoria);
        }

        if ($request->filled('tipo')) {
            $query->where('formato', $request->tipo);
        }

        match ($request->get('orden', 'nombre')) {
            'precio_asc'  => $query->orderBy('precio'),
            'precio_desc' => $query->orderByDesc('precio'),
            default       => $query->orderBy('nombre')->orderBy('precio'),
        };

        $productos  = $query->get();
        $categorias = Producto::where('disponible', true)->distinct()->orderBy('nombre')->pluck('nombre');
        $formatos   = Producto::where('disponible', true)->distinct()->orderBy('formato')->pluck('formato');

        return view('productos.index', compact('productos', 'categorias', 'formatos'));
    }

    public function show(Producto $producto): View
    {
        return view('productos.show', compact('producto'));
    }
}
