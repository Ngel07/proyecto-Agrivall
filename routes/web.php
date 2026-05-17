<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CasillaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\AdminPedidoController;

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
Route::get('/conocenos', fn() => view('conocenos.index'))->name('conocenos.index');
Route::get('/contacto', fn() => view('contacto.index'))->name('contacto.index');

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/',                             [CarritoController::class, 'index'])->name('index');
    Route::post('/añadir/{producto}',           [CarritoController::class, 'añadir'])->name('añadir');
    Route::patch('/actualizar/{productoId}',    [CarritoController::class, 'actualizar'])->name('actualizar');
    Route::delete('/eliminar/{productoId}',     [CarritoController::class, 'eliminar'])->name('eliminar');
    Route::delete('/vaciar',                    [CarritoController::class, 'vaciar'])->name('vaciar');
});

Route::prefix('pedido')->name('pedido.')->group(function () {
    Route::get('/checkout',              [PedidoController::class, 'checkout'])->name('checkout');
    Route::post('/confirmar',            [PedidoController::class, 'confirmar'])->name('confirmar');
    Route::get('/confirmacion/{pedido}', fn(\App\Models\Pedido $pedido) => view('pedido.confirmacion', compact('pedido')))->name('confirmacion');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/',  fn() => view('admin.dashboard'))->name('dashboard');
    Route::resource('productos', AdminProductoController::class)->except(['show']);
    Route::resource('pedidos', AdminPedidoController::class)->only(['index', 'show']);
    Route::patch('pedidos/{pedido}/estado', [AdminPedidoController::class, 'updateEstado'])->name('pedidos.updateEstado');
    Route::redirect('/posts',    '/admin')->name('posts.index');
    Route::redirect('/reservas', '/admin')->name('reservas.index');
});

/*
|--------------------------------------------------------------------------
| Autenticación (solo para el admin)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login',  [AdminAuthController::class, 'login'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate']);
Route::post('/admin/logout',[AdminAuthController::class, 'logout'])->name('logout');
