<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Negocio;
use Illuminate\Http\Request;

class Validations extends Controller
{
    
    /* REGISTRO DE USUARIOS */

    public function registerUser(Request $request){
        
        $tipo_usuario = $request->input('tipo_usuario');

        if ($tipo_usuario == 2) {

            $doc_usuario = $request->input('doc_usuario');
            $nombre = $request->input('nombre_completo');
            $correo = $request->input('correo');
            $password = $request->input('contrasena');
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $user = Usuario::create([
                'id_usuario' => $doc_usuario,
                'nombre' => $nombre,
                'correo' => $correo,
                'contrasena' => $passwordHash
            ]);
        }else if ($tipo_usuario == 1) {
            $negocio = Negocio::create([
                'id_negocio' => $id_negocio,
                ''
            ]);
        }

    }



}
