<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
            $password = trim($request->input('contrasenaUsuario'));

            $hashPassword = Hash::make($password);

            $user = Usuario::create([
                'id_usuario' => $doc_usuario,
                'nombre' => $nombre,
                'contrasena' => $hashPassword
            ]);
            return redirect()->route('login');
        }else if ($tipo_usuario == 1) {
            
            $nit_negocio = $request->input('nitNegocio'); 
            $nombre = $request->input('nombreNegocio');
            $password = $request->input('contrasenaNegocio');
           
            $hashPassword = Hash::make($password);

            $negocio = Negocio::create([
                'id_negocio' => $nit_negocio,
                'nombre_negocio' => $nombre,
                'contrasena' => $hashPassword
            ]);
            return redirect()->route('login');
            
        }

    }

/* LOGIN DE USUARIOS */
    
public function loginUser(Request $request){
        
    $tipo_usuario = $request->input('tipo_usuario');

if ($tipo_usuario == 1) {
    $doc_usuario = $request->input('documentoUsuario');
    $password = trim($request->input('passwordUsuario')); // trim evita los espacios
    
    $userData = Usuario::where('id_usuario', $doc_usuario)->first();

    if ($userData) { 
        if (Hash::check($password, $userData->contrasena)) {
            // limpiar cualquier sesion anterir
            Auth::guard('usuario')->logout();
            Auth::guard('usuario')->login($userData);
            session()->regenerate();
            session([
                'usuario_id' => $userData->id_usuario,
                'usuario_tipo' => 'usuario'
            ]);

            Log::info('Login exitoso:', [
                'usuario_id' => $userData->id_usuario,
                'auth_check' => Auth::guard('usuario')->check(),
                'session_id' => session()->getId(),
                'user_data' => Auth::guard('usuario')->user()
            ]);
            //dd(session()->all());
            if(Auth::guard('usuario')->check()){
                return redirect()->to('/usuarios/index');
            }else{
                dd("Error: el usuario no esta autenticado despues del login");
            }

        } else {
            // Error al no coincidir las contraseñas
            dd("Error con la contreaseña");
        }
    } else {
        dd("Error al no encontrar usuario");
    }
     
    }else if($tipo_usuario == 2){

        $nit = $request->input('nitNegocio');
        $password = $request->input('contrasenaNegocio');
        
        $negocioData = Negocio::where('id_negocio', $nit)->first();
        if($negocioData){
            if(Hash::check($password, $negocioData->contrasena)){
                Auth::guard('negocio')->login($negocioData);
                if(Auth::guard('negocio')->check()){
                    //Usuario autenticado y session iniciada
                    return redirect()->to('/negocio/config');
                }else{
                    dd("Error: el usuario no esta autenticado despues del login");
                }
            }else{
                dd("Error con la contreaseña");
            }
        }
    }

}

}