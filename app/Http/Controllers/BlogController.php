<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog.index');
    }

    public function show(): View
    {
        return view('blog.show');
    }
}
