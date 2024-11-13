<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewsController;




/* ACTUALIZACION DE VISTAS RESPONSIVE DEL PROYECTO MYLOOK */
Route::get('/indexbienvenida', [ViewsController::class, 'showIndexPrincipal'])-> name('formLoginPrincipal');
Route::get('/loginbienvenida', [ViewsController::class, 'showLoginPrincipal']);
