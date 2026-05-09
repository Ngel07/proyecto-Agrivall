<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/productos', [PublicController::class, 'productos'])->name('productos.index');
Route::get('/productos/{producto}', [PublicController::class, 'show'])->name('productos.show');

// Rutas pendientes de implementar — redirigen al home de momento
Route::redirect('/blog', '/')->name('blog.index');
Route::redirect('/blog/{post}', '/')->name('blog.show');
Route::redirect('/casilla', '/')->name('casilla.index');
Route::redirect('/contacto', '/')->name('contacto.index');

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::redirect('/', '/')->name('index');
    Route::redirect('/añadir/{producto}', '/')->name('añadir');
    Route::redirect('/actualizar/{producto}', '/')->name('actualizar');
    Route::redirect('/eliminar/{producto}', '/')->name('eliminar');
    Route::redirect('/vaciar', '/')->name('vaciar');
});

Route::prefix('pedido')->name('pedido.')->group(function () {
    Route::redirect('/checkout', '/')->name('checkout');
    Route::redirect('/confirmar', '/')->name('confirmar');
    Route::redirect('/confirmacion/{pedido}', '/')->name('confirmacion');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/')->name('dashboard');
    Route::redirect('/productos', '/')->name('productos.index');
    Route::redirect('/posts', '/')->name('posts.index');
    Route::redirect('/pedidos', '/')->name('pedidos.index');
    Route::redirect('/reservas', '/')->name('reservas.index');
});

/*
|--------------------------------------------------------------------------
| Autenticación (solo para el admin)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', fn() => redirect('/'))->name('login');
Route::post('/admin/login', fn() => redirect('/'));
Route::post('/admin/logout', fn() => redirect('/'))->name('logout');
