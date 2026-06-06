<?php

namespace App\Http\Controllers;

use App\Models\PostBlog;
use App\Models\TipoPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $tipos = TipoPost::orderBy('tipo')->get();

        $posts = PostBlog::with('tipo')
            ->when($request->categoria, fn ($q, $cat) => $q->whereHas('tipo', fn ($q2) => $q2->where('tipo', $cat)))
            ->orderByDesc('fecha_public')
            ->get();

        return view('blog.index', compact('posts', 'tipos'));
    }

    public function show(PostBlog $post): View
    {
        $post->load('tipo');

        $relacionados = PostBlog::with('tipo')
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relacionados'));
    }
}
