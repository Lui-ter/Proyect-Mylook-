<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Negocio;
use App\Models\Categoria;
use App\Models\TipoServicio;
use App\Models\Servicio;
use App\Models\Producto;
use Illuminate\Http\Request;

class Validations extends Controller
{
    
    /* REGISTRO DE USUARIOS */

    public function registerUser(Request $request){
        
        $tipo_usuario = $request->input('tipo_usuario');

        if ($tipo_usuario == 2) {

            $doc_usuario = $request->input('docUsuario');
            $nombre = $request->input('nombreCompletoUsuario');
            $password = $request->input('contrasenaUsuario');
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            
            $user = Usuario::create([
                'id_usuario' => $doc_usuario,
                'nombre' => $nombre,
                'contrasena' => $passwordHash
            ]);
            return redirect()->route('configPerfil');
        }else if ($tipo_usuario == 1) {
            
            $nit_negocio = $request->input('nitNegocio'); 
            $nombre = $request->input('nombreNegocio');
            $password = $request->input('contrasenaNegocio');
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            
            $negocio = Negocio::create([
                'id_negocio' => $nit_negocio,
                'nombre_negocio' => $nombre,
                'contrasena' => $passwordHash
            ]);
            return redirect()->route('registeradmin');
            
        }

    }

    /* LOGIN DE USUARIOS */
    
    public function loginUser(Request $request){
        
    $tipo_usuario = $request->input('tipo_usuario');

    if ($tipo_usuario == 1) {
        
        $doc_usuario = $request->input('documentoUsuario');
        $password = $request->input('contraseñaUsuario');

        $userData = Usuario::where('id_usuario', $doc_usuario)->first();
        
        if ($doc_usuario == $userData->id_usuario && password_verify($password,$userData->contrasena)) {
            return redirect()->to('/indexusuario');
        }else{
            return redirect()->to('/loginbienvenida');
        }
        
    }else if($tipo_usuario == 2){

        $nit = $request->input('nitNegocio');
        $password = $request->input('contrasenaNegocio');

        $negocioData = Negocio::where('id_negocio', $nit)->first();

        if ($nit == $negocioData->id_negocio && password_verify($password,$negocioData->contrasena)) {
            return redirect()->to('/indexadmin');
        }else{
            return redirect()->to('/loginbienvenida');
        }
    }

}

    /* LOGICA DE CATEGORIA */

    public function handleAddCategory(Request $request){

    $nombre = $request->input('nombreCategoria');
    $imagen = file_get_contents($request->file('imgCategoria')->getRealPath());
    $desc = $request->input('descripcionCategoria');


    if (!empty($nombre) && !empty($imagen) && !empty('desc')) {
        $category = Categoria::create([
            'nom_categoria' => $nombre,
            'desc_categoria' => $desc,
            'imagen' => $imagen
        ]);

        echo "Insercion Exitosa";
        }else{
            echo "Fallo en la inserción";
        }

    }

    /* LOGICA DE VALORACIONES */

    public function handleAddValoration(){

        $id_cita = $request->input('id_cita');
        $comentario = $request->input('comentario');
        $calificacion = $request->input('calificacion');

        if (!empty($id_cita) && !empty($comentario) && !empty($calificacion)) {

            Valoracion::create([
                'id_cita' => $id_cita,
                'comentario' => $comentario,
                'calificacion' => $calificacion,
            ]);

            return redirect('#');

        }
    }
    

    /* LOGICA DE SERVICIOS */

    public function handleAddServiceType(Request $request){

    $id_categoria = $request->input('Categoria');

    $tipoServ = $request->input('nombreServicios');

    if (!empty($id_categoria) && !empty('tipoServ')) {

            $tipo = TipoServicio::create([
                'id_categoria' => $id_categoria,
                'tipo_serv' => $tipoServ
            ]);

            echo "Inserción realizada correctamente";
        }

    }

    public function handleAddService(Request $request){
    

    $tipoServicio = $request->input('tipoServicio');
    $nombre = $request->input('nombreServicio');
    $precio = $request->input('precioServicio');
    $desc = $request->input('descripcionServicio');
    $duracion = $request->input('duracionServicio');
    $imagen = file_get_contents($request->file('imagenServicio')->getRealPath());

    if (!empty($tipoServicio) && !empty($nombre) && !empty($precio) && !empty($desc) && !empty($duracion) && !empty($imagen)) {
        
        $service = Servicio::create([
                'id_tiposerv' => $tipoServicio,
                'nom_servicio' => $nombre,
                'desc_servicio' => $desc,
                'duracion_serv' => $duracion,
                'precio_servicio' => $precio,
                'img_serv' => $imagen
        ]);

        echo "Todo se insertó correctamente";
    }else{
        echo "Faltan campos por diligenciar, no se pudo insertar el registro";
    }

    }

    /* LOGICA DE PRODUCTOS */

    public function handleAddProduct(Request $request){
    
    $nombre = $request->input('nombre');
    $marca = $request->input('marca');
    $imagen = file_get_contents($request->file('imagen')->getRealPath());
    $desc = $request->input('desc');
    $cantidad = $request->input('cantidad');
    $valor = $request->input('valor');

    if (!empty($nombre) && !empty($marca) && !empty($imagen) && !empty($desc) && !empty($cantidad) && !empty($valor)) {
        
        $product = Producto::create([
            'nombre_prod' => $nombre,
            'nom_marca' => $marca,
            'desc_prod' => $desc,
            'stock' => $cantidad,
            'valor_prod' => $valor,
            'img_prod' => $imagen
        ]);

        echo "Se insertó el producto correctamente";
        return redirect('indexadmin');

    }else{
        echo "Faltan campos por diligenciar";
    }


    }

    /* LOGICA DE CONFIGURACIONES DE PERFIL - (FALTAN VISTAS) */

    /* ACTUALIZACIÓN DE USUARIO */

    public function handleUpdateUser(Request $request){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $usuario = Usuario::where('id_usuario', $id)->first();

            $usuario->nombre = $request->input('nombre');
            $usuario->apellido = $request->input('apellido');
            $usuario->correo = $request->input('correo');
            $usuario->contrasena = $request->input('contrasena');
            $usuario->telefono = $request->input('telefono');
            $usuario->condicion = $request->input('condicion');

            $usuario->save();

            
        }

        return redirect('#');

    }

    /* ACTUALIZACIÓN DE NEGOCIO */

    public function handleUpdateBussiness(){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $negocio = Negocio::where('id_negocio', $id)->first();

            $negocio->nombre_negocio = $request->input('nombre_negocio');
            $negocio->contrasena = $request->input('contrasena');
            $negocio->desc_negocio = $request->input('desc_negocio');

            $negocio->save();

            
        }

        return redirect('#');

    }

    /* ACTUALIZACIÓN DE ESTABLECIMIENTO */

    public function handleUpdateHeadQuarter(){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $establecimiento = Establecimiento::where('id_usuario', $id)->first();

            $establecimiento->id_negocio = $request->input('id_negocio');
            $establecimiento->nombre_establc = $request->input('nombre_establc');
            $establecimiento->desc_establc = $request->input('desc_establc');
            $establecimiento->ubicacion = $request->input('ubicacion');
            $establecimiento->correo = $request->input('correo');
            $establecimiento->telefono = $request->input('telefono');
            $establecimiento->img_establc = file_get_contents($request->file('img_establc')->getRealPath());

            $establecimiento->save();

            
        }

        return redirect('#');

    }

    /* ACTUALIZACIÓN DE STAFF */

    public function handleUpdateStaff(){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $staff = Staff::where('id_usuario', $id)->firstOrFail();

            $staff->telefono = $request->input('telefono');
            $staff->img_staff = file_get_contents($request->file('img_staff')->getRealPath());

            $staff->save();

        }

        return redirect('#');

    }
    

    /* LOGICA DE ACTUALIZACIONES - (FALTAN VISTAS)*/

    /* ACTUALIZACION DE CATEGORIA */

    public function handleUpdateCategory(Request $request){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $categoria = Categoria::where('id_categoria', $id)->firstOrFail();

            $categoria->nom_categoria = $request->input('nom_categoria');
            $categoria->desc_categoria = $request->input('desc_categoria');
            $categoria->imagen = file_get_contents($request->file('imagen')->getRealPath());

            $categoria->save();

        }
 
        return redirect('#');

    }

    /* ACTUALIZACION DE PRODUCTO */

    public function handleUpdateProduct(Request $request){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $producto = Producto::where('id_producto', $id)->firstOrFail();

            $producto->nombre_prod = $request->input('nombre_prod');
            $producto->nom_marca = $request->input('nom_marca');
            $producto->desc_prod = $request->input('desc_prod');
            $producto->img_prod = file_get_contents($request->file('img_prod')->getRealPath());
            $producto->stock = $request->input('stock');
            $producto->valor_prod = $request->input('valor_prod');

            $producto->save();

        }


        return redirect('#');

    }

    /* ACTUALIZACION DE TIPO SERVICIO */

    public function handleUpdateTypeService(Request $request){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $tipoServicio = TipoServicio::where('id_tiposerv', $id)->firstOrFail();

            $tipoServicio->tipo_serv = $request->input('tipo_serv');
            
            $tipoServicio->save();


        }

        
        return redirect('#');


    }

    /* ACTUALIZACION DE SERVICIO */

    public function handleUpdateService(Request $request){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $servicio = Servicio::where('id_servicio', $id)->firstOrFail();

            $servicio->nom_servicio = $request->input('nom_servicio');
            $servicio->desc_servicio = $request->input('desc_servicio');
            $servicio->img_serv = $request->input('img_serv');
            $servicio->duracion_serv = $request->input('duracion_serv');
            $servicio->precio_servicio = $request->input('precio_servicio');

        }

        

        return redirect('#');


    }

    /* LOGICA DE ELIMINACIÓN */

    /* ELIMINACION DE CATEGORIA */
    
    public function handleDeleteCategory(Request $request){
        
        $id = $request->input('deleteButton');
        
        $category = Categoria::where('id_categoria', $id)->first();
        
        if ($category) {
            
            $category->destroy();
            
        }
        
        
        return redirect('#');


    }

    /* ELIMINACION DE TIPO DE SERVICIO */
    
    public function handleDeleteTypeService(Request $request){
        
        $id = $request->input('deleteButton');
        
        $tipoServicio = TipoServicio::where('id_tiposerv', $id)->first();
        
        if ($tipoServicio) {
            
            $tipoServicio->destroy();
            
        }

        
        
        return redirect('#');
        
        
    }

    /* ELIMINACION DE PRODUCTO */
    
    public function handleDeleteProduct(Request $request){
        
        $id = $request->input('deleteButton');
        
        $product = Producto::where('id_producto', $id)->first();

        if ($product) {
            
            $product->destroy();
            
        }
        
        return redirect('#');
        
    }
    
    /* ELIMINACION DE STAFF */
    
    public function handleDeleteStaff(Request $request){
        
        $id = $request->input('deleteButton');
        
        $staff = Staff::where('id_producto', $id)->first();
        
        if ($staff) {
            
            $staff->id_rol = 1;
            $staff->save();

        } 
        
        return redirect('#');
        
    }

    /* ELIMINACION DE ESTABLECIMIENTO */
    
    public function handleDeleteHeadQuarter(Request $request){
        
        $id = $request->input('deleteButton');
        
        $establecimiento = Establecimiento::where('id_establc')->first();
        
        if ($establecimiento) {
            
            $establecimiento->destroy();
            
        }
        
        return redirect('#');
        
    }

    /* ELIMINACION DE NEGOCIO */
    
    public function handleDeleteBussiness(Request $request){

        $id = $request->input('deleteButton');

        $negocio = Negocio::where('id_negocio', $id)->first();

        if ($negocio) {
            
            $negocio->destroy();

        }

        return redirect('#');

    }

    /* NOTA: AÚN FALTAN ALGUNAS LOGICAS, ESTAMOS A LA ESPERA DE LA ACTUALIZACIÓN DE LA BD PARA PROSEGUIR */

}
