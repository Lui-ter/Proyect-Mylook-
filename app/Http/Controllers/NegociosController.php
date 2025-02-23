<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negocio;
use App\Helpers\GlobalVariables;

class NegociosController extends Controller
{

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
        }else{
            return redirect()->route('admin');
        }

    }

}
