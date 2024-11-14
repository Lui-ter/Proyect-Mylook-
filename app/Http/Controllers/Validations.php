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
            dd("Login Exitoso");
        }else{
            dd("Login Fallido");
        }

    }else if($tipo_usuario == 2){

        $nit = $request->input('nitNegocio');
        $password = $request->input('contrasenaNegocio');

        $negocioData = Negocio::where('id_negocio', $nit)->first();

        if ($nit == $negocioData->id_negocio && password_verify($password,$negocioData->contrasena)) {
            dd("Login Exitoso");
        }else{
            dd("Login Fallido");
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

    }else{
        echo "Faltan campos por diligenciar";
    }


}


}
