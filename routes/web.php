<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewsController;
use App\Http\Controllers\Validations;

/* ACTUALIZACION DE VISTAS RESPONSIVE DEL PROYECTO MYLOOK */
Route::get('/loginbienvenida', [viewsController::class, 'showLoginPrincipal']);

/* VALIDACIONES DEL LOGIN */

Route::post('/register-user', [Validations::class, 'registerUser'])->name('registerUser');
Route::post('/login-user', [Validations::class, 'loginUser'])->name('loginUser');

/* VALIDACIONES DE LOS FORMULARIOS */
Route::post('/register-category', [Validations::class, 'handleAddCategory'])->name('registerCategory');
Route::post('/register-type-service', [Validations::class, 'handleAddServiceType'])->name('registerServiceType');
Route::post('/register-service', [Validations::class, 'handleAddService'])->name('registerService');
Route::post('/register-product', [Validations::class, 'handleAddProduct'])->name('registerProduct');


/* LOGIN Y REGISTROS DE LOS PRINPALES USUARIOS DE MYLOOK -------------------------------------------- */

/* PAGINA PRINCIPAL DE MYLOOK */
Route::get('/welcometomylook', [viewsController::class, 'showIndexPrincipal']);
/* LOGIN PRINCIPAL DE MYLOOK USUARIOS Y ESTABLECEMIENTO */
Route::get('/loginbienvenida', [viewsController::class, 'showLoginPrincipal']);
/* INDEX USUARIO */
Route::get('/indexusuario', [viewsController::class, 'showIndexUsuario']);
/* INDEX AGENDAMIENTO */
Route::get('/indexagendamiento', [viewsController::class, 'showIndexAgendamiento']);
/* INDEX PANEL ADMIN INICIO SESION */
Route::get('/panelAdmin', [viewsController::class, 'showPanelAdmin']);
/* REGISTRAR ADMIN */
Route::get('/registeradmin', [viewsController::class, 'showRegisterAdmin']);
/* INDEX ADMIN */
Route::get('/indexadmin', [viewsController::class, 'showIndexAdmin']);
/* INDEX STAFF */
Route::get('/indexstaff', [viewsController::class, 'showIndexStaff']);
/* LOGUIAR STAFF */
Route::get('/loguinstaff', [viewsController::class, 'showLoginStaff']);
/* ---------------------------------------------------------------------------------------------------- */

/* INSERCCIONES DE GESTION DE ESTABLECIMIENTO MYLOOK */

/* PRODUCTOS */
Route::get('/inserccionproductos', [viewsController::class, 'crudProductos']);
/* SERVICIOS */
Route::get('/inserccionservicios', [viewsController::class, 'crudServicios']);
/* TIPOS DE SERVICIOS */
Route::get('/insercciontipservicios', [viewsController::class, 'crudTipServicios']);
/* CATEGORIAS */
Route::get('/inserccioncategoria', [viewsController::class, 'crudCategorias']);
/* STAFF */
Route::get('/inserccionstaff', [viewsController::class, 'crudStaff']);

/* --------------------------------------------------------------------------------------------------------- */

/* CONFIGURACION DEL PERFIL */

/* CONFIGURACION DEL PERFIL */
Route::get('/configuracionperfil', [viewsController::class, 'configPerfil']);
/* REGISTRAR SEDE */
Route::get('/configuracionsede', [viewsController::class, 'configStaff']);

/* --------------------------------------------------------------------------------------------------------- */








