<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;

// 1. Si alguien entra a la web sin loguearse, lo mandamos al LOGIN directamente
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Creamos las rutas de Login y Registro
Auth::routes();

// 3. PROTECCIÓN TOTAL: Solo los usuarios logueados pueden entrar a productos.
// Si alguien intenta escribir /productos en la URL sin estar logueado, 
// Laravel lo expulsará automáticamente al Login.
Route::middleware(['auth'])->group(function () {
    
    // Ruta principal del CRUD
    Route::resource('productos', ProductoController::class);
    
    // Redirigir el /home (que usa Laravel por defecto) hacia el listado de productos
    Route::get('/home', [ProductoController::class, 'index'])->name('home');
});