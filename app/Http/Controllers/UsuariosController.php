<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use App\Models\Establecimiento;

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
            $mejoresEstablecimientos = Establecimiento::orderByDesc('valoracion_final')
            ->take(7)
            ->get(['id_establc','nombre_establc', 'img_establc','desc_establc'])
            ->toArray();
            return view($indexUsuarioView, compact('mejoresEstablecimientos')); 
        }elseif($accion === 'agendar'){
            return view($agendamientoView);
        }elseif($accion === 'config'){
            return view($configUsersView);
        }else{
            return redirect()->route('usuarios', ['accion' => 'index']);
        }

    }


}
