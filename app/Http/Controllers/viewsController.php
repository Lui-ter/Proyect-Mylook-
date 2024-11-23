<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\TipoServicio;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Staff;
use App\Models\Establecimiento;
use App\Models\Negocio;

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

     /* INSERCION PRODUCTOS DE MYLOOK */
     function crudProductos(){
        return view('Fomularios.Insercciones.registerProductos');
    }

     /* INSERCION SERVICIOS DE MYLOOK */
     function crudServicios(){

        $typeServices = TipoServicio::all()->toArray();

        return view('Fomularios.Insercciones.registerServicios', compact('typeServices'));
    }

     /* INSERCION TIPOS SERVICIOS DE MYLOOK */
     function crudTipServicios(){

        $categoryData = Categoria::all()->toArray();

        return view('Fomularios.Insercciones.registerTipServicio', compact('categoryData'));
    }

      /* INSERCION CATEGORIAS DE MYLOOK */
      function crudCategorias(){

        return view('Fomularios.Insercciones.registerCategoria');
    }

      /* EDICION PRODUCTOS DE MYLOOK */
      function crudEditProductos(Request $request){

        $id = $request->input('#');

        $producto = Producto::where('id_producto', $id)->first();

        return view('Fomularios.Insercciones.registerCategoria', compact('producto'));
    }

    /* EDICION SEDE DE MYLOOK */
    function crudEditEstablecimiento(Request $request){

        $id = $request->input('#');

        $establ = Establecimiento::where('id_establc', $id)->first();

        return view('Fomularios.Insercciones.registerCategoria', compact('establ'));
    }

    /* EDICION NEGOCIO DE MYLOOK */
    function crudEditNegocio(Request $request){

        $id = $request->input('#');

        $negocio = Negocio::where('id_negocio', $id)->first();

        return view('Fomularios.Insercciones.registerCategoria', compact('negocio'));
    }

      

    /* -------------------------------------------------------------------------------------------------------------- */


      /* COFIGURACION PERFIL USUARIO DE MYLOOK */
      function configPerfil(Request $request){

        $id = $request->input('#');

        $usuario = Usuario::where('id_producto', $id)->first();

        return view('Config.configUsers', compact('usuario'));
    }

       /* COFIGURACION SEDE DE MYLOOK */
       function configStaff(Request $request){

        $id = $request->input('#');

        $staff = Staff::where('id_staff', $id)->first();

        return view('Config.configSedes', compact('staff'));

    }
}
