<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function productos(): View
    {
        return view('productos.index');
    }

    public function productoDetalle(\App\Models\Producto $producto): View
    {
        return view('productos.show', compact('producto'));
    }
}
