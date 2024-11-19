<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\TipoServicio;

class viewsController extends Controller
{

    /* VISTA PRINCIPAL DE MYLOOK */
    function showIndexPrincipal(){
        return view('Index.indexBienvenida');
    }

    /* LOGIN PRINCIPAL DE MYLOOK */
    function showLoginPrincipal(){
        return view('Fomularios.Login.formLoginPrincipal');
    }

     /*INDEX USUARIO DE MYLOOK */
     function showIndexUsuario(){
        return view('Index.indexUsuario');
    }

     /* INDEX AGENDAMIENTO DE MYLOOK */
     function showIndexAgendamiento(){
        return view('Index.indexAgenda');
    }

     /* INDEX PANEL DE INICIO DE SESION ADMIN DE MYLOOK */
     function showPanelAdmin(){
        return view('Fomularios.Login.loginAdmin');
    }

     /* REGISTRO DE ADMIN */
     function showRegisterAdmin(){
        return view('Fomularios.Login.registerAdmin');
    }

     /* INDEX ADMIN DE MYLOOK */
     function showIndexAdmin(){
        return view('Index.indexAdmin');
    }

     /* INDEX STAFF DE MYLOOK */
     function showIndexStaff(){
        return view('Index.indexStaff');
    }

    /* REGISTRAR STAFF DE MYLOOK */
    function crudStaff(){
    return view('Fomularios.Login.registerStaff');
    }

     /* LOGIN STAFF DE MYLOOK */
     function showLoginStaff(){
        return view('Fomularios.Login.loginStaff');
    }

     /* CRUD PRODUCTOS DE MYLOOK */
     function crudProductos(){
        return view('Fomularios.Insercciones.registerProductos');
    }

     /* CRUD SERVICIOS DE MYLOOK */
     function crudServicios(){

        $typeServices = TipoServicio::all()->toArray();

        return view('Fomularios.Insercciones.registerServicios', compact('typeServices'));
    }

     /* CRUD TIPOS SERVICIOS DE MYLOOK */
     function crudTipServicios(){

        $categoryData = Categoria::all()->toArray();

        return view('Fomularios.Insercciones.registerTipServicio', compact('categoryData'));
    }

      /* CRUD CATEGORIAS DE MYLOOK */
      function crudCategorias(){

        return view('Fomularios.Insercciones.registerCategoria');
    }

    /* -------------------------------------------------------------------------------------------------------------- */


      /* COFIGURACION PERFIL USUARIO DE MYLOOK */
      function configPerfil(){
        return view('Config.configUsers');
    }

       /* COFIGURACION SEDE DE MYLOOK */
       function configStaff(){
        return view('Config.configSedes');
    }
}
