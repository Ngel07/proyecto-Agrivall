<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CasillaController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/productos', [PublicController::class, 'productos'])->name('productos.index');
Route::get('/productos/{producto}', [PublicController::class, 'show'])->name('productos.show');

// Rutas pendientes de implementar — redirigen al home de momento
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/casilla', [CasillaController::class, 'index'])->name('casilla.index');
Route::get('/contacto', fn() => view('contacto.index'))->name('contacto.index');

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', fn() => view('carrito.index'))->name('index');
    Route::post('/añadir/{producto}', fn() => back())->name('añadir');
    Route::redirect('/actualizar/{producto}', '/')->name('actualizar');
    Route::redirect('/eliminar/{producto}', '/')->name('eliminar');
    Route::redirect('/vaciar', '/')->name('vaciar');
});

Route::prefix('pedido')->name('pedido.')->group(function () {
    Route::get('/checkout', fn() => view('pedido.checkout'))->name('checkout');
    Route::post('/confirmar', fn() => redirect(route('pedido.confirmacion', ['pedido' => 1001])))->name('confirmar');
    Route::get('/confirmacion/{pedido}', fn(string $pedido) => view('pedido.confirmacion', ['numeroPedido' => $pedido]))->name('confirmacion');
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
Route::get('/admin/login', fn() => view('admin.auth.login'))->name('login');
Route::post('/admin/login', fn() => redirect('/'));
Route::post('/admin/logout', fn() => redirect('/'))->name('logout');
