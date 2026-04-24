<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CasillaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\PostBlogController;
use App\Http\Controllers\Admin\PedidoAdminController;
use App\Http\Controllers\Admin\ReservaController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::view('/', 'index');
/*Route::get('/', [PublicController::class, 'index'])->name('home');*/
Route::get('/productos', [PublicController::class, 'productos'])->name('productos.index');
Route::get('/productos/{producto}', [PublicController::class, 'productoDetalle'])->name('productos.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/casilla', [CasillaController::class, 'index'])->name('casilla.index');
Route::post('/casilla/reserva', [CasillaController::class, 'solicitarReserva'])->name('casilla.reserva');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');

/*
|--------------------------------------------------------------------------
| Carrito y pedidos (sin login — cliente anónimo)
|--------------------------------------------------------------------------
*/

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index');
    Route::post('/añadir/{producto}', [CarritoController::class, 'añadir'])->name('añadir');
    Route::patch('/actualizar/{producto}', [CarritoController::class, 'actualizar'])->name('actualizar');
    Route::delete('/eliminar/{producto}', [CarritoController::class, 'eliminar'])->name('eliminar');
    Route::delete('/vaciar', [CarritoController::class, 'vaciar'])->name('vaciar');
});

Route::prefix('pedido')->name('pedido.')->group(function () {
    Route::get('/checkout', [PedidoController::class, 'checkout'])->name('checkout');
    Route::post('/confirmar', [PedidoController::class, 'confirmar'])->name('confirmar');
    Route::get('/confirmacion/{pedido}', [PedidoController::class, 'confirmacion'])->name('confirmacion');
});

/*
|--------------------------------------------------------------------------
| Panel de administración
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('productos', ProductoController::class);
    Route::resource('posts', PostBlogController::class);
    Route::resource('pedidos', PedidoAdminController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('reservas', ReservaController::class);
});

/*
|--------------------------------------------------------------------------
| Autenticación (solo para el admin)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
