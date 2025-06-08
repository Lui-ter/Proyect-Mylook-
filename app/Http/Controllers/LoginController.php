<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use App\Models\Usuario;
use App\Models\Negocio;
use App\Models\Establecimiento;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /* LOGIN PRINCIPAL DE MYLOOK */
    public function showLoginPrincipal()
    {
        $loginView = GlobalVariables::$loginView;
        return view($loginView);
    }
    public function showLandingPage()
    {
        $indexView = GlobalVariables::$indexView;
        $mejoresEstablecimientos = Establecimiento::with('negocio')
            ->orderByDesc('valoracion_final')
            ->take(3)
            ->get();
        return view($indexView, compact('mejoresEstablecimientos'));
        if ($accion === 'indexBienvenida') {
            return view($indexView, ($this->showLandingPage()));
    }
}
    /* REGISTRO DE USUARIOS */
    public function registerUser(Request $request)
    {
        $tipo_usuario = $request->input('tipo_usuario');
        if ($tipo_usuario == 2) {
            // Aqui recibe los datos del form para la creacion del usuario
            $doc_usuario = $request->input('docUsuario');
            $nombre = $request->input('nombreCompletoUsuario');
            $password = trim($request->input('contrasenaUsuario'));
            $hashPassword = Hash::make($password);
            $userData = Usuario::create([
                'id_usuario' => $doc_usuario,
                'nombre' => $nombre,
                'contrasena' => $hashPassword
            ]);
            // Aqui se crea la sesion del login cuando un usuario se registra por primera vez
            Auth::guard('usuario')->logout();
            Auth::guard('usuario')->login($userData);
            session()->regenerate();
            $request->session()->regenerateToken();
            session([
                'usuario_id' => $userData->id_usuario,
                'usuario_tipo' => 'usuario'
            ]);
            return redirect()->route('usuarios', ['accion' => 'register']);
        } else if ($tipo_usuario == 1) {
            // Variable global de la vista del formulario del userAdmin
            $registerAdminView = GlobalVariables::$registerAdminView;
            // Aqui recibe los datos del form para la creacion del negocio
            $nit_negocio = $request->input('nitNegocio');
            $nombre = $request->input('nombreNegocio');
            $password = $request->input('contrasenaNegocio');
            $hashPassword = Hash::make($password);
            $negocioData = Negocio::create([
                'id_negocio' => $nit_negocio,
                'nombre_negocio' => $nombre,
                'contrasena' => $hashPassword
            ]);
            Auth::guard('negocio')->logout();
            Auth::guard('negocio')->login($negocioData);
            session()->regenerate();
            $request->session()->regenerateToken();
            session([
                'id_negocio' => $negocioData->id_negocio,
                'usuario_tipo' => 'negocio'
            ]);
            return view($registerAdminView);
        }
    }

    /* LOGIN DE USUARIOS */
    public function loginUser(Request $request)
    {
        $tipo_usuario = $request->input('tipo_usuario');
        if ($tipo_usuario == 1) {
            $doc_usuario = $request->input('documentoUsuario');
            $password = trim($request->input('passwordUsuario')); // trim evita los espacios
            $userData = Usuario::where('id_usuario', $doc_usuario)->first();
            if ($userData) {
                if (Hash::check($password, $userData->contrasena)) {
                    // limpiar cualquier sesion anterior
                    Auth::guard('usuario')->logout();
                    Auth::guard('usuario')->login($userData);
                    session()->regenerate();
                    $request->session()->regenerateToken();
                    $idUsuario = Auth::guard('usuario')->user()->id_usuario;
                    $idStaff = staff::where('id_usuario', $idUsuario)->pluck('id_staff')->first();
                    // valido si se recibe un staff su tipo staff sino es usuario
                    $tipoUsuario = $idStaff ? 'staff' : 'usuario';
                    session([
                        'usuario_id' => $userData->id_usuario,
                        'tipo_usuario' =>  $tipoUsuario,
                        'id_staff' => $idStaff
                    ]);
                    /* Depuracion de los auth y guards
                    Log::info('Login exitoso:', [
                        'usuario_id' => $userData->id_usuario,
                        'auth_check' => Auth::guard('usuario')->check(),
                        'session_id' => session()->getId(),
                        'user_data' => Auth::guard('usuario')->user()
                    ]);
                    */
                    //dd(session()->all());
                    if (!$userData->apellido || !$userData->correo || !$userData->telefono) {
                        return redirect()->route('usuarios', ['accion' => 'register']);
                    }
                    if (Auth::guard('usuario')->check()) {
                        return redirect()->to('/usuarios/index');
                    } else {
                        dd("Error: el usuario no esta autenticado despues del login");
                    }
                } else {
                    // Error al no coincidir las contraseñas
                    return back()
                        ->withErrors(['passwordUsuario' => 'La contraseña no concuerda con el ID ingresado.',])
                        ->withInput();
                }
            } else {
                return back()
                    ->withErrors(['documentoUsuario' => 'No se encontró ningún usuario con ese ID.',])
                    ->withInput();
            }
        } else if ($tipo_usuario == 2) {
            // Aqui se definen las variables globales de las vistas
            $registerAdminView = GlobalVariables::$registerAdminView;
            $configNegocio = GlobalVariables::$registerNegocio;
            $nit = $request->input('nitNegocio');
            $password = trim($request->input('contrasenaNegocio'));
            $negocioData = Negocio::where('id_negocio', $nit)->first();
            // Aqui se verifica si el negocio existe
            if (!$negocioData) {
                return back()
                    ->withErrors(['nitNegocio' => 'No se encontró ningún negocio con ese NIT.',])
                    ->withInput()->with('mostrarNegocio', true);
            }
            if (isset($negocioData->id_usuario)) {
                if (Hash::check($password, $negocioData->contrasena)) {
                    Auth::guard('negocio')->logout();
                    Auth::guard('negocio')->login($negocioData);
                    session()->regenerate();
                    $request->session()->regenerateToken();
                    session([
                        'id_negocio' => $negocioData->id_negocio,
                        'usuario_tipo' => 'negocio'
                    ]);
                    /*
                    log::info('login exitoso',[
                        'id_negocio' => $negocioData->id_negocio,
                        'auth_check' => Auth::guard('negocio')->check(),
                        'session_id' => session()->getId(),
                        'user_data' => Auth::guard('negocio')->user(),
                        'session_data' => session()->all()
                    ]);
                    */
                    //dd(session()->all());
                    // Aqui si hay un administrador en el negocio pero las demas configuraciones del negocio estan null redirigir a esta vista
                    if (!$negocioData->desc_negocio || !$negocioData->img_portada || !$negocioData->img_perfil) {
                        return view($configNegocio, [
                            'negocio' => $negocioData,
                            'admin' => $negocioData->usuario,
                        ]);
                    }
                    // Si no hay un establecimiento relacionado al negocio logueado redirigir a esta vista
                    if (!Establecimiento::where('id_negocio', $negocioData->id_negocio)->exists()) {
                        return redirect()->route('establecimientos', ['accion' => 'register']);
                    }
                    // Si toda la configuracion esta bien redirigir a esta ruta
                    if (Auth::guard('negocio')->check()) {
                        return redirect()->route('admin', ['accion' => 'index']);
                    } else {
                        dd("Error: el usuario no esta autenticado despues del login");
                    }
                } else {
                    return back()
                        ->withErrors(['contrasenaNegocio' => 'La contraseña no concuerda con el NIT ingresado.',])
                        ->withInput()->with('mostrarNegocio', true);
                }
            } else {
                //Si el negocio no ha configurado config negocio, debera por primera vez agregarlos
                if (Hash::check($password, $negocioData->contrasena)) {
                    Auth::guard('negocio')->logout();
                    Auth::guard('negocio')->login($negocioData);
                    session()->regenerate();
                    $request->session()->regenerateToken();
                    session([
                        'id_negocio' => $negocioData->id_negocio,
                        'usuario_tipo' => 'negocio'
                    ]);
                    if (Auth::guard('negocio')->check()) {
                        return view($registerAdminView);
                    } else {
                        dd("Error: el usuario no esta autenticado despues del login");
                    }
                } else {
                    dd("Error con la contreaseña");
                }
            }
        }
    }
}
