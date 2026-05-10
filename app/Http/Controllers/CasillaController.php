<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CasillaController extends Controller
{
    public function index(): View
    {
        return view('casilla.index');
    }
}
