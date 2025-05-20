<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use App\Models\Usuario;
use App\Models\Negocio;
use App\Models\Establecimiento;
use App\Models\Staff;

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

public function loginUser(Request $request)
{
    $tipo_usuario = $request->input('tipo_usuario');

    // ========== USUARIO ==========
    if ($tipo_usuario == 1) {
        $doc_usuario = $request->input('documentoUsuario');
        $password = trim($request->input('passwordUsuario'));

        $userData = Usuario::where('id_usuario', $doc_usuario)->first();

        if (!$userData) {
            return back()->withErrors([
                'documentoUsuario' => 'No se encontró ningún usuario con ese ID.',
            ])->withInput();
        }

        if (!Hash::check($password, $userData->contrasena)) {
            return back()->withErrors([
                'passwordUsuario' => 'La contraseña no concuerda con el ID ingresado.',
            ])->withInput();
        }

        // Login exitoso
        Auth::guard('usuario')->logout();
        Auth::guard('usuario')->login($userData);
        session()->regenerate();
        $request->session()->regenerateToken();

        $idUsuario = $userData->id_usuario;
        $idStaff = staff::where('id_usuario', $idUsuario)->pluck('id_staff')->first();
        $idStaff = $idStaff ?? 'nulo';
        $tipoUsuario = $idStaff ? 'staff' : 'usuario';

        session([
            'usuario_id' => $idUsuario,
            'tipo_usuario' => $tipoUsuario,
            'id_staff' => $idStaff
        ]);

        return redirect()->to('/usuarios/index');
    }

    // ========== NEGOCIO ==========
    if ($tipo_usuario == 2) {
        $registerAdminView = GlobalVariables::$registerAdminView;
        $configNegocio = GlobalVariables::$registerNegocio;
        $registerEstablecimiento = GlobalVariables::$registerEstablecimiento;

        $nit = $request->input('nitNegocio');
        $password = trim($request->input('contrasenaNegocio'));

        $negocioData = Negocio::where('id_negocio', $nit)->first();

        if (!$negocioData) {
            return back()->withErrors([
                'nitNegocio' => 'No se encontró ningún negocio con ese NIT.',
            ])->withInput()->with('mostrarNegocio', true);
        }

        if (!Hash::check($password, $negocioData->contrasena)) {
            return back()->withErrors([
                'contrasenaNegocio' => 'La contraseña no concuerda con el NIT ingresado.',
            ])->withInput()->with('mostrarNegocio', true);
        }

        // Login exitoso
        Auth::guard('negocio')->logout();
        Auth::guard('negocio')->login($negocioData);
        session()->regenerate();
        $request->session()->regenerateToken();

        session([
            'id_negocio' => $negocioData->id_negocio,
            'usuario_tipo' => 'negocio'
        ]);

        if (!$negocioData->desc_negocio || !$negocioData->img_portada || !$negocioData->img_perfil) {
            return view($configNegocio, [
                'negocio' => $negocioData,
                'admin' => $negocioData->usuario,
            ]);
        }

        if (!Establecimiento::where('id_negocio', $negocioData->id_negocio)->exists()) {
            return view($registerEstablecimiento);
        }

        return redirect()->to('negocio/index');
    }
}
}
