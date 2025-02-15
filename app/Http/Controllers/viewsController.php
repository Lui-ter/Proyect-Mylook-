<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\TipoServicio;
use App\Models\Servicio;
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
     function showConfigBienvenida(){
        return view('Config.configBienvenidaMiNegocio');
    }


     /* INDEX ADMIN DE MYLOOK */
     function showIndexAdmin(){

        $categorias = Categoria::all()->toArray();

        $productsPreview = Producto::latest()->take(3)->get()->toArray();

        $infoStaff = Staff::with('usuario', 'rol')->get()->toArray();


        
        foreach ($categorias as &$categoria) {
            if (isset($categoria['imagen'])) {
                $categoria['imagen'] = 'data:image/png;base64,' . base64_encode($categoria['imagen']);
            }
        }

        foreach ($productsPreview as &$productPreview){
            if (isset($productPreview['img_prod'])) {
                $productPreview['img_prod'] = 'data:image/png;base64,' . base64_encode($productPreview['img_prod']);
            }
        }

        foreach ($infoStaff as &$staff){
            if (isset($staff['img_staff'])) {
                $staff['img_staff'] = 'data:image/png;base64,' . base64_encode($staff['img_staff']);
            }
        }

      return view('Index.indexAdmin', compact('categorias','productsPreview', 'infoStaff'));
    

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
    function insertProductos(){
        return view('Fomularios.Insercciones.registerProductos');
    }

     function crudProductos(Request $request){

        if ($request->has('editProducto')) {
            $id = $request->input('editProducto');
            $producto = Producto::where('id_prod', $id)->first();
            $producto['img_prod'] = 'data:image/png;base64,' . base64_encode($producto['img_prod']);
            return view('Fomularios.Insercciones.registerProductos', compact('producto'));
        }elseif ($request->has('deleteProducto')) {
            $id = $request->input('deleteProducto');
            $producto = Producto::where('id_prod', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');
        }else{
            return view('Fomularios.Insercciones.registerProductos');
        }
    }

     /* INSERCION SERVICIOS DE MYLOOK */
     function crudServicios(Request $request){

        if ($request->has('editServicio')) {
            $id = $request->input('editServicio');
            $servicio = Servicio::where('id_servicio', $id)->first();
            $servicio['img_serv'] = 'data:image/png;base64,' . base64_encode($servicio['img_serv']);
            $typeServices = TipoServicio::all()->toArray();
            $modeValidator = '1';
            return view('Fomularios.Insercciones.registerServicios', compact('servicio','typeServices','modeValidator'));
        }elseif ($request->has('deleteServicio')) {
            $id = $request->input('deleteServicio');
            $servicio = Servicio::where('id_servicio', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');
        }else{
            $modeValidator = '2';
            $typeServices = TipoServicio::all()->toArray();
            return view('Fomularios.Insercciones.registerServicios', compact('typeServices','modeValidator'));
        }

        $typeServices = TipoServicio::all()->toArray();

        return view('Fomularios.Insercciones.registerServicios', compact('typeServices'));
    }

     /* INSERCION TIPOS SERVICIOS DE MYLOOK */
     function crudTipoServicios(Request $request){

        if ($request->has('editTipoServicio')) {
            $id = $request->input('editTipoServicio');
            $typeServices = TipoServicio::where('id_tiposerv',$id)->first();
            $categoryData = Categoria::all()->toArray();
            $modeValidator = '1';
            return view('Fomularios.Insercciones.registerTipServicio', compact('typeServices','modeValidator','categoryData'));
        }elseif ($request->has('deleteTipoServicio')) {
            $id = $request->input('deleteTipoServicio');
            $typeServices = TipoServicio::where('id_tiposerv',$id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');
        }else{
            $modeValidator = '2';
            $typeServices = TipoServicio::all()->toArray();
            $categoryData = Categoria::all()->toArray();
            return view('Fomularios.Insercciones.registerTipServicio', compact('typeServices','modeValidator','categoryData'));
        }

        /* 

        return view('Fomularios.Insercciones.registerTipServicio', compact('categoryData')); */
    }
      /* INSERCION CATEGORIAS DE MYLOOK */
      function crudCategorias(){

        return view('Fomularios.Insercciones.registerCategoria');
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

    function crudViewProductos(){
        
        $productos = Producto::all()->toArray();

        foreach ($productos as &$producto) {
            if (isset($producto['img_prod'])) {
                $producto['img_prod'] = 'data:image/png;base64,' . base64_encode($producto['img_prod']);
            }
        }

        return view('viewCrud.Admin.viewProductos', compact('productos'));
    }

    function crudViewServicios(){
        
        $servicios = Servicio::all()->toArray();

        foreach ($servicios as &$servicio) {
            if (isset($servicio['img_serv'])) {
                $servicio['img_serv'] = 'data:image/png;base64,' . base64_encode($servicio['img_serv']);
            }
        }

        $tipoServicio = TipoServicio::all()->toArray();

        return view('viewCrud.Admin.viewServicios', compact('servicios','tipoServicio'));
    }

    function crudViewTipoServicios(){
        
        $tipoServicios = TipoServicio::all()->toArray();

        return view('viewCrud.Admin.viewTiproductos', compact('tipoServicios'));
    }

    

    /* -------------------------------------------------------------------------------------------------------------- */


      /* COFIGURACION PERFIL USUARIO DE MYLOOK */
      function configPerfil(Request $request){

        $id = $request->input('');

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
