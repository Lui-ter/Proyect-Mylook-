<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Negocio;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
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

        // Aqui a travez del id_negocio que viene del formulario, hago una consulta para encontrar el usuario registrado a ese negocio
        $Negocio = Negocio::find($request->idNegocio);
        $id_usuario = $Negocio->id_usuario;

        // Aqui creo el registro en la tabla staff relacionando el usuario anteriormente registrado, establecimiento, negocio y el rol de administrador
        Staff::create([
            'id_usuario' => $id_usuario,
            'id_establc' => $request->idEstablc,
            'id_negocio' => $request->idNegocio,
            'id_rol' => 1
        ]);

        // Se elimina de la sesion el dato que estaba cargado en el formulario de negocio
        session()->forget(['id_negocio']);

        return redirect()->route('admin', ['accion' => 'index']);
    }


/* ACTUALIZACIÓN DE ESTABLECIMIENTO */

    public function handleUpdateEstablecimiento(Request $request, $id){
        $request->validate([
            'idNegocio' => 'required|exists:negocio,id_negocio',
            'idEstablc' => 'required|exists:establecimiento,id_establc',
            'nombreEst' => 'required|string|max:70',
            'descripcionEstablecimiento' => 'nullable|string|max:250',
            'direccionEstablecimiento' => 'required|string|max:50',
            'correoEstablecimiento' => 'required|email|max:50|unique:establecimiento,correo,' . $id . ',id_establc',
            'telefonoEstablecimiento' => 'nullable|string|max:15|regex:/^\d+$/',
        ]);
        $establecimiento = Establecimiento::findOrFail($id);
        $establecimiento->update([
            'nombre_establc' => $request->nombreEst,
            'desc_establc' => $request->descripcionEstablecimiento,
            'ubicacion' => $request-> direccionEstablecimiento,
            'correo' => $request-> correoEstablecimiento,
            'telefono' => $request-> telefonoEstablecimiento,
        ]);

        return redirect()->back()->with('completado', 'Establecimiento actualizado correctamente.');
    }

/* ELIMINACION DE ESTABLECIMIENTO */

    public function handleDeleteHeadQuarter(Request $request, $id){

        $id = $request->input('deleteButton');

        $establecimiento = Establecimiento::where('id_establc', 'id')->first();

        if ($establecimiento) {

            $establecimiento->delete();

        }

        return redirect('#');

    }

    public function crudEstablecimientos(Request $request, $accion = null){

        if($accion === 'config'){
            $configEstablecimiento = GlobalVariables::$configEstablecimiento;
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $establecimiento = Establecimiento::where('id_negocio', $idNegocio)->first();
            return view($configEstablecimiento,[
                'establecimiento' => $establecimiento,
                'idNegocio' => $idNegocio
            ]);
        }
    }
}
