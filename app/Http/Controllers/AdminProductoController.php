<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::latest()->simplePaginate(20);

        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'     => ['required', 'string', 'max:120'],
            'variedad'   => ['nullable', 'string', 'max:80'],
            'formato'    => ['nullable', 'string', 'max:60'],
            'precio'     => ['required', 'numeric', 'min:0'],
            'imagen'     => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'disponible' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('imagen')) {
            $file     = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/productos'), $filename);
            $data['imagen'] = 'images/productos/' . $filename;
        }

        $data['disponible'] = $request->boolean('disponible');

        Producto::create($data);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre'     => ['required', 'string', 'max:120'],
            'variedad'   => ['nullable', 'string', 'max:80'],
            'formato'    => ['nullable', 'string', 'max:60'],
            'precio'     => ['required', 'numeric', 'min:0'],
            'imagen'     => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'disponible' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }
            $file     = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/productos'), $filename);
            $data['imagen'] = 'images/productos/' . $filename;
        } else {
            unset($data['imagen']);
        }

        $data['disponible'] = $request->boolean('disponible');

        $producto->update($data);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado.');
    }
}
