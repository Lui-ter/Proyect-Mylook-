<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Helpers\GlobalVariables;

class EstablecimientosController extends Controller{

/*  INSERCION DE UN ESTABLECIMIENTO   */

    public function handleAddEstablecimiento(Request $request){

    // Aqui se validan los datos que provienen del formulario de establecimiento
        $request->validate([
            'idEstablc' => 'required|numeric|unique:establecimiento,id_establc',
            'idNegocio' => 'required|numeric|unique:establecimiento,id_negocio',
            'nombreEst' => 'required|string|max:30',
            'direccionEstablecimiento' => 'required|string|max:30',
            'descripcionEstablecimiento' => 'required|string',
            'telefonoEstablecimiento' => 'nullable|numeric|unique:establecimiento,telefono',
            'correoEstablecimiento' => 'nullable|email|unique:establecimiento,correo'
        ]);

        // Aqui se crea un nuevo un nuevo registro de establecimiento en la tabla
        Establecimiento::create([
            'id_establc' => $request->idEstablc,
            'id_negocio' => $request->idNegocio,
            'nombre_establc' => $request->nombreEst,
            'ubicacion' => $request->direccionEstablecimiento,
            'desc_establc' => $request->descripcionEstablecimiento,
            'telefono' => $request->telefonoEstablecimiento,
            'correo' => $request->correoEstablecimiento
        ]);

        // Se elimina de la sesion el dato que estaba cargado en el formulario de negocio
            session()->forget(['id_negocio']);

        return redirect()->route('admin', ['accion' => 'index']);
    }


    /* ACTUALIZACIÓN DE ESTABLECIMIENTO */

    public function handleUpdateHeadQuarter(Request $request, $id){

            /* Validación de datos que llegan del form */
            $request->validate([
                'idNegocio' => 'required|exists:establecimiento,id_establc',
                'nombreEstablecimiento' => 'required|string|max:70',
                'descripEstablecimiento' => 'nullable|string|max:250',
                'direccionEstablecimiento' => 'required|string|max:50',
                'correoEstablecimiento' => 'required|email|max:50|unique:establecimiento,correo,' . $id,
                'telefonoEstablecimiento' => 'nullable|string|max:15',
            ]);

            $establecimiento = Establecimiento::findOrFail($id);

            $establecimiento->id_establc = $request->input('idNegocio');
            $establecimiento->nombre_establc = $request->input('nombreEstablecimiento');
            $establecimiento->desc_establc = $request->input('descripEstablecimiento');
            $establecimiento->ubicacion = $request->input('direccionEstablecimiento');
            $establecimiento->correo = $request->input('correoEstablecimiento');
            $establecimiento->telefono = $request->input('telefonoEstablecimiento');

            $establecimiento->save();

            return redirect()->back()->with('completado', 'Establecimiento actualizado correctamente.');
        }

    /* ELIMINACION DE ESTABLECIMIENTO */

    public function handleDeleteHeadQuarter(Request $request, $id){

        $id = $request->input('deleteButton');

        $establecimiento = Establecimiento::where('id_establc', 'id')->first();

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