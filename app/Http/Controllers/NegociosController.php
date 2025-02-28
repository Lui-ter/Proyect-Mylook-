<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Negocio;
use Illuminate\Contracts\Session\Session;
use App\Helpers\GlobalVariables;


class NegociosController extends Controller{

    /* ACTUALIZACIÓN DE NEGOCIO */

    public function handleUpdateNegocio(Request $request, $id){

        // Aqui se validan los datos que provienen del formulario de negocio
        $request->validate([
            'id_usuario' => 'required|numeric',
            'descripcionNegocio' => 'required|string'
        ]);

        // Aqui se actualiza el registro de negocio encontrado a travez de su id
        $negocioData = Negocio::findOrFail($id);
        $negocioData->id_usuario = $request->input('id_usuario');
        $negocioData->desc_negocio = $request->input('descripcionNegocio');
        $negocioData->save();

        // Aqui guarda la id_negocio en la sesión para usarlo en el formulario de establecimiento ya que esta en la misma vista
        session(['id_negocio' => $negocioData->id_negocio]);

        // Aqui se elimina de la sesion los datos que estaban cargados en el formulario de perfil administrador
        session()->forget(['id_usuario','nombreAdmin', 'apellidoAdmin']);

        return view('Configuracion/configBienvenidaMiNegocio',compact('negocioData'));
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


    public function crudNegocios(Request $request, $accion = null){

        $configNegocio = GlobalVariables::$configBienvenidaMiNegocio;

        if($accion === 'config'){
            return view($configNegocio);
        }elseif($accion === 'logout'){
            Auth::guard('usuario')->logout();
            $request->session()->invalidate();
           
            $indexView = GlobalVariables::$indexView;
            return view($indexView);
        }else{
            return redirect()->route('admin');
        }

    }

}