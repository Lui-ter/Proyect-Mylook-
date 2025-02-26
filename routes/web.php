<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewsController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TiposServiciosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NegociosController;
use App\Http\Controllers\EstablecimientosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Validations;

/* --------------------------------------------------------------------------------------- */

/* PAGINA PRINCIPAL DE MYLOOK */
Route::get('/', [LoginController::class, 'showLandingPage'])->name('landing');
/* CRUD DE PRODUCTOS */
Route::match(['get', 'post'], '/productos/{accion?}', [ProductosController::class, 'crudProductos'])->name('productos');
/* CRUD DE SERVICIOS */
Route::match(['get', 'post'], '/servicios/{accion?}', [ServiciosController::class, 'crudServicios'])->name('servicios');
/* CRUD DE TIPO DE SERVICIOS */
Route::match(['get', 'post'], '/tipoServicios/{accion?}', [TiposServiciosController::class, 'crudTipoServicios'])->name('tipoServicios');
/* CRUD DE CATEGORIAS */
Route::match(['get', 'post'], '/categorias/{accion?}', [CategoriasController::class, 'crudCategorias'])->name('categorias');
/* CRUD DE STAFF */
Route::match(['get', 'post'], '/staff/{accion?}', [StaffController::class, 'crudStaff'])->name('staff');
/* CRUD DE ESTABLECIMIENTOS */
Route::match(['get', 'post'], '/establecimientos/{accion?}', [EstablecimientosController::class, 'crudEstablecimientos'])->name('establecimientos');


/* CRUD DE NEGOCIOS */
Route::middleware(['ValidateSession:usuario'])->group(function(){
    Route::match(['get', 'post'], '/negocio/{accion?}', [NegociosController::class, 'crudNegocios'])->name('negocio');
});
/* CRUD DE USUARIOS */
Route::middleware(['ValidateSession:usuario'])->group(function(){
    Route::match(['get', 'post'], '/usuarios/{accion?}', [UsuariosController::class, 'crudUsuarios'])->name('usuarios');
});


/* CRUD DE ADMIN */
Route::match(['get', 'post'], '/admin/{accion?}', [AdminController::class, 'crudAdmin'])->name('admin');
/* LOGIN GENERAL */


Route::get('/login', [LoginController::class, 'showLoginPrincipal'])->name('login');
/* RUTAS POST - VALIDACIONES */
Route::post('/login-user', [LoginController::class, 'loginUser'])->name('loginUser');
/* --------------------------------------------------------------------------------------- */

/* RUTAS POST - INSERCIONES */
Route::post('/register-category', [CategoriasController::class, 'handleAddCategory'])->name('registerCategory');
Route::post('/register-type-service', [TiposServiciosController::class, 'handleAddServiceType'])->name('registerServiceType');
Route::post('/register-service', [ServiciosController::class, 'handleAddService'])->name('registerService');
Route::post('/register-product', [ProductosController::class, 'handleAddProduct'])->name('registerProduct');
Route::post('/register-user', [LoginController::class, 'registerUser'])->name('registerUser');
Route::post('/register-staff', [StaffController::class, 'handleAddStaff'])->name('registerStaff');
Route::post('/register-useradmin', [UsuariosController::class, 'handleAddUser'])->name('registerUserAdmin');
Route::post('/register-establecimiento', [EstablecimientosController::class, 'handleAddEstablecimiento'])->name('registerEstablecimiento');
Route::post('/register-negocio', [NegociosController::class, 'handleAddNegocio'])->name('registerNegocio');



/* RUTAS PUT - UPDATES */
Route::put('/update-category/{id}', [CategoriasController::class, 'handleUpdateCategory'])->name('updateCategory');
Route::put('/update-type-service/{id}', [TiposServiciosController::class, 'handleUpdateServiceType'])->name('updateServiceType');
Route::put('/update-service/{id}', [ServiciosController::class, 'handleUpdateService'])->name('updateService');
Route::put('/update-product/{id}', [ProductosController::class, 'handleUpdateProduct'])->name('updateProduct');
Route::put('/update-user/{id}', [UsuariosController::class, 'handleUpdateUsers'])->name('updateUsers');


/* RUTAS DELETE - DELETE */
Route::delete('/delete-category', [CategoriasController::class, 'handleDeleteCategory'])->name('deleteCategory');
Route::delete('/delete-type-service', [TiposServiciosController::class, 'handleDeleteServiceType'])->name('deleteServiceType');
Route::delete('/delete-service', [ServiciosController::class, 'handleDeleteService'])->name('deleteService');
Route::delete('/delete-product', [ProductosController::class, 'handleDeleteProduct'])->name('deleteProduct');



/* --------------------------------------------------------------------------------------- */
