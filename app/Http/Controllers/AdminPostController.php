<?php

namespace App\Http\Controllers;

use App\Models\PostBlog;
use App\Models\TipoPost;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminPostController extends Controller
{
    public function index(): View
    {
        $posts = PostBlog::with('tipo')->latest('fecha_public')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $tipos = TipoPost::orderBy('tipo')->get();

        return view('admin.posts.create', compact('tipos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'titulo'       => ['required', 'string', 'max:255'],
            'noticia'      => ['required', 'string'],
            'fecha_public' => ['required', 'date'],
            'tipo_post_id' => ['required', 'exists:tipos_post,id'],
            'imagen'       => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('imagen')) {
            $file     = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/blog'), $filename);
            $data['imagen'] = 'blog/' . $filename;
        }

        PostBlog::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post creado correctamente.');
    }

    public function edit(PostBlog $post): View
    {
        $tipos = TipoPost::orderBy('tipo')->get();

        return view('admin.posts.edit', compact('post', 'tipos'));
    }

    public function update(Request $request, PostBlog $post): RedirectResponse
    {
        $data = $request->validate([
            'titulo'       => ['required', 'string', 'max:255'],
            'noticia'      => ['required', 'string'],
            'fecha_public' => ['required', 'date'],
            'tipo_post_id' => ['required', 'exists:tipos_post,id'],
            'imagen'       => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($post->imagen && file_exists(public_path('images/' . $post->imagen))) {
                unlink(public_path('images/' . $post->imagen));
            }
            $file     = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/blog'), $filename);
            $data['imagen'] = 'blog/' . $filename;
        } else {
            unset($data['imagen']);
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post actualizado correctamente.');
    }

    public function destroy(PostBlog $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post eliminado correctamente.');
    }
}
