<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Helpers\GlobalVariables;

class EstablecimientosController extends Controller
{

    /* ACTUALIZACIÓN DE ESTABLECIMIENTO */

    public function handleUpdateHeadQuarter(){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $establecimiento = Establecimiento::where('id_usuario', $id)->first();

            $establecimiento->id_negocio = $request->input('id_negocio');
            $establecimiento->nombre_establc = $request->input('nombre_establc');
            $establecimiento->desc_establc = $request->input('desc_establc');
            $establecimiento->ubicacion = $request->input('ubicacion');
            $establecimiento->correo = $request->input('correo');
            $establecimiento->telefono = $request->input('telefono');
            $establecimiento->img_establc = file_get_contents($request->file('img_establc')->getRealPath());

            $establecimiento->save();

            
        }

        return redirect('#');

    }

    /* ELIMINACION DE ESTABLECIMIENTO */
    
    public function handleDeleteHeadQuarter(Request $request){
        
        $id = $request->input('deleteButton');
        
        $establecimiento = Establecimiento::where('id_establc')->first();
        
        if ($establecimiento) {
            
            $establecimiento->destroy();
            
        }
        
        return redirect('#');
        
    }

    public function crudEstablecimientos(Request $request, $accion = null){
        
        if($accion === 'config'){
            $configEstablecimiento = GlobalVariables::$configEstablecimiento;
            return view($configEstablecimiento); /* Esta vista aún no existe aparentemente */
        }

    }

}
