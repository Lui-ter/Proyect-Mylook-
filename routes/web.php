<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewsController;
use App\Http\Controllers\Validations;




/* ACTUALIZACION DE VISTAS RESPONSIVE DEL PROYECTO MYLOOK */
Route::get('/indexbienvenida', [viewsController::class, 'showIndexPrincipal']);
Route::get('/loginbienvenida', [viewsController::class, 'showLoginPrincipal']);

/* VALIDACIONES DEL LOGIN */

Route::post('/register-user', [Validations::class, 'registerUser'])->name('registerUser');


