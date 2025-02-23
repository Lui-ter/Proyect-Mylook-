<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use App\Models\Usuario;
use App\Models\Negocio;

class LoginController extends Controller
{

/* LOGIN PRINCIPAL DE MYLOOK */

    public function showLoginPrincipal(){
        $loginView = GlobalVariables::$loginView;
        return view($loginView);
    }

    public function showLandingPage(){
        $indexView = GlobalVariables::$indexView;
        return view($indexView);
    }

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
            return redirect()->route('usuarios', ['accion' => 'config']);
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
            return redirect()->route('negocio', ['accion' => 'config']);
            
        }

    }

/* LOGIN DE USUARIOS */
    
    public function loginUser(Request $request){
        
        $tipo_usuario = $request->input('tipo_usuario');
    
        if ($tipo_usuario == 1) {
            
            $doc_usuario = $request->input('documentoUsuario');
            $password = $request->input('passwordUsuario');
    
            $userData = Usuario::where('id_usuario', $doc_usuario)->first();
            
            if ($doc_usuario == $userData->id_usuario && password_verify($password,$userData->contrasena)) {
                return redirect()->to('/usuarios');
            }else{
                return redirect()->to('/login');
            }
            
        }else if($tipo_usuario == 2){
    
            $nit = $request->input('nitNegocio');
            $password = $request->input('contrasenaNegocio');
    
            $negocioData = Negocio::where('id_negocio', $nit)->first();
    
            if ($nit == $negocioData->id_negocio && password_verify($password,$negocioData->contrasena)) {
                return redirect()->to('/admin');
            }else{
                return redirect()->to('/login');
            }
        }
    
    }

}
