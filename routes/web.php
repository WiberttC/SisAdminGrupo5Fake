<?php

use App\Http\Controllers\categoriaController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\compraController;
use App\Http\Controllers\ventaController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\userController;
use App\Http\Controllers\roleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteController;

Route::get('/', [homeController::class, 'index'])->name('panel')->middleware('auth');




Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'login']);
Route::get('/logout', [logoutController::class, 'logout'])->name('logout');






Route::view('/panel', 'panel.index')->name('panel');

Route::resources([
    'categorias' => categoriaController::class,
    'marcas' => marcaController::class,
    'presentaciones' => presentacioneController::class,
    'productos' => productoController::class,
    'clientes' => clienteController::class,
    'proveedores' => proveedorController::class,
    'compras' => compraController::class,
    'ventas' => ventaController::class,
    'users' => userController::class,
    'roles' => roleController::class,

]);

Route::get('/reportes/ventas-dia', [ReporteController::class, 'ventasPorDia'])->name('reportes.ventasPorDia');
Route::get('/reportes/ventas-cliente', [ReporteController::class, 'ventasPorCliente'])->name('reportes.ventasPorCliente');
Route::get('/reportes/ventas-producto', [ReporteController::class, 'ventasPorProducto'])->name('reportes.ventasPorProducto');

Route::get('/401', function () {
    return view('pages.401');
});
