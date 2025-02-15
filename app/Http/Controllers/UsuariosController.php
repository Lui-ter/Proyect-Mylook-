<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;

class UsuariosController extends Controller
{

    /*INDEX USUARIO DE MYLOOK */

     function showIndexUsuario(){
        return view('Index.indexUsuario');
    }

    public function crudUsuarios(Request $request, $accion = null){

        $indexUsuarioView = GlobalVariables::$indexUsuarioView;
        $agendamientoView = GlobalVariables::$agendamientoView;
        $configUsersView = GlobalVariables::$configUsersView;

        if ($accion === 'index') {
            return view($indexUsuarioView);
        }elseif($accion === 'agendar'){
            return view($agendamientoView);
        }elseif($accion === 'config'){
            return view($configUsersView);
        }else{
            return redirect()->route('usuarios', ['accion' => 'index']);
        }

    }


}
