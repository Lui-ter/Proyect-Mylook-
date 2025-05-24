<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewsController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContrasenasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NegociosController;
use App\Http\Controllers\EstablecimientosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\notificacionController;
use App\Http\Controllers\Validations;
use App\Http\Controllers\ValoracionesController;

/* --------------------------------------------------------------------------------------- */
/* PAGINA PRINCIPAL DE MYLOOK */
Route::get('/', [LoginController::class, 'showLandingPage'])->name('landing')->defaults('accion', 'indexBienvenida');

/* LOGIN GENERAL */
Route::get('/login', [LoginController::class, 'showLoginPrincipal'])->name('login');

/* CRUD DE USUARIOS */
Route::middleware(['ValidateSession:usuario'])->group(function(){
    Route::match(['get', 'post'], '/usuarios/{accion?}', [UsuariosController::class, 'crudUsuarios'])->name('usuarios');
});
/* CRUD DE NEGOCIOS */
Route::middleware(['ValidateSession:negocio'])->group(function(){
    Route::match(['get', 'post'], '/negocio/{accion?}', [NegociosController::class, 'crudNegocios'])->name('negocio');
});
/* CRUD DE ADMIN */
Route::middleware(['ValidateSession:negocio'])->group(function(){
    Route::match(['get', 'post'], '/admin/{accion?}', [AdminController::class, 'crudAdmin'])->name('admin');
});
/* CRUD DE PRODUCTOS */
Route::middleware(['ValidateSession:negocio'])->group(function(){
    Route::match(['get', 'post'], '/productos/{accion?}', [ProductosController::class, 'crudProductos'])->name('productos');
});
/* CRUD DE CATEGORIAS */
Route::middleware(['ValidateSession:negocio'])->group(function(){
    Route::match(['get', 'post'], '/categorias/{accion?}', [CategoriasController::class, 'crudCategorias'])->name('categorias');
});
/* CRUD DE SERVICIOS */
Route::middleware(['ValidateSession:negocio'])->group(function(){
    Route::match(['get', 'post'], '/servicios/{accion?}', [ServiciosController::class, 'crudServicios'])->name('servicios');
});
/* CRUD DE STAFF */
Route::middleware(['ValidateSession:negocio'])->group(function(){
    Route::match(['get', 'post'], '/staff/{accion?}', [StaffController::class, 'crudStaff'])->name('staff');
});

/* CRUD DE ESTABLECIMIENTOS */
Route::middleware(['ValidateSession:negocio'])->group(function() {
    Route::match(['get', 'post'], '/establecimientos/{accion?}', [EstablecimientosController::class, 'crudEstablecimientos'])->name('establecimientos');
});

/* RUTAS POST - VALIDACIONES */
Route::post('/login-user', [LoginController::class, 'loginUser'])->name('loginUser');

/* RUTAS PARA LA RECUPERACION DE CONTRASEÑA DE USUARIOS Y NEGOCIOS */
Route::match(['get', 'post'],'/contrasenas/{accion?}', [ContrasenasController::class, 'contrasenasOlvidadas'])->name('contrasenas');

/* --------------------------------------------------------------------------------------- */

/* RUTAS POST - INSERCIONES */
Route::post('/register-category', [CategoriasController::class, 'handleAddCategory'])->name('registerCategory');
Route::post('/register-service', [ServiciosController::class, 'handleAddService'])->name('registerService');
Route::post('/register-product', [ProductosController::class, 'handleAddProduct'])->name('registerProduct');
Route::post('/register-user', [LoginController::class, 'registerUser'])->name('registerUser');
Route::post('/register-staff', [StaffController::class, 'handleAddStaff'])->name('registerStaff');
Route::post('/register-useradmin', [AdminController::class, 'handleAddUserAdmin'])->name('registerUserAdmin');
Route::post('/register-establecimiento', [EstablecimientosController::class, 'handleAddEstablecimiento'])->name('registerEstablecimiento');
Route::post('/register-negocio', [NegociosController::class, 'handleAddNegocio'])->name('registerNegocio');
Route::post('/register-valoracion', [ValoracionesController::class, 'handleAddValoracion'])->name('registerValoracion');


/* RUTAS PUT - UPDATES */
Route::put('/update-category/{id}', [CategoriasController::class, 'handleUpdateCategory'])->name('updateCategory');
Route::put('/update-service/{id}', [ServiciosController::class, 'handleUpdateService'])->name('updateService');
Route::put('/update-product/{id}', [ProductosController::class, 'handleUpdateProduct'])->name('updateProduct');
Route::put('/update-userone', [UsuariosController::class, 'userUpdate'])->name('userUpdate');
Route::put('/update-user/{id}', [UsuariosController::class, 'handleUpdateUsers'])->name('updateUsers');
Route::put('/update-user-admin/{id}', [AdminController::class, 'handleUpdateUserAdmin'])->name('updateUserAdmin');
Route::put('/update-negocio', [NegociosController::class, 'handleUpdateNegocio'])->name('updateNegocio');
Route::put('/update-negocio-two/{id}', [NegociosController::class, 'handleUpdateNegocioTwo'])->name('updateNegocioTwo');
Route::put('/update-establecimiento/{id}', [EstablecimientosController::class, 'handleUpdateEstablecimiento'])->name('updateEstablecimiento');
Route::put('/update-staff/{id}', [StaffController::class, 'handleUpdateStaff'])->name('updateStaff');
Route::put('/update-valoracion/{id}', [ValoracionesController::class, 'handleUpdateValoracion'])->name('updateValoracion');


/* RUTAS DELETE - DELETE */
Route::delete('/delete-category', [CategoriasController::class, 'handleDeleteCategory'])->name('deleteCategory');
Route::delete('/delete-service', [ServiciosController::class, 'handleDeleteService'])->name('deleteService');
Route::delete('/delete-product', [ProductosController::class, 'handleDeleteProduct'])->name('deleteProduct');
Route::delete('/staff/{id}', [StaffController::class, 'handleDeleteStaff'])->name('deleteStaff');
Route::delete('delete-notificacion/{id}',[notificacionController::class,'borrarNotificacion'])->name('deleteNotificacion');
Route::delete('delete-valoracion/{id}',[ValoracionesController::class,'borrarValoracion'])->name('deleteValoracion');


/* RUTAS GET - OBTENER */
Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('editStaff');
Route::get('/staff', [StaffController::class, 'getStaff'])->name('getStaff');
Route::get('/form-valoracion', [ValoracionesController::class, 'showFormValoracion'])->name('formValoracion');


/* RUTAS DE OLVIDAR CONTRASEÑA */
Route::post('/consultar-correo', [ContrasenasController::class, 'consultarCorreo'])->name('consultarCorreo');
Route::post('/codigo-correo', [ContrasenasController::class, 'codigoVerificacion'])->name('codigoVerificacion');
Route::post('/nueva-contrasena', [ContrasenasController::class, 'nuevaContrasena'])->name('nuevaContrasena');

/* --------------------------------------------------------------------------------------- */

Route::get('/configurar-negocio', function () {
    return view('Configuracion.administrador.configurarNegocio');
});

Route::get('/configurar-establecimiento', function () {
    return view('Configuracion.administrador.configurarEstablecimiento');
});

Route::get('/configurar-perfil', function () {
    return view('Configuracion.administrador.configurarPerfil');
});
