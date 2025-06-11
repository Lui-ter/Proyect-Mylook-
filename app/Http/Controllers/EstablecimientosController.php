<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Negocio;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Helpers\GlobalVariables;
use App\Models\notificacion;

class EstablecimientosController extends Controller{


    private function notificacionUsuario()
    {
        if (Auth::guard('usuario')->check()) {
            // Notificaciones de usuario
            $notificaciones = notificacion::with('cita')->where('estado', 'Aceptado')->get()->map(function ($notificacion) {
                return array_merge(
                    $notificacion->toArray(),
                    [
                        'fecha' => $notificacion->cita ? $notificacion->cita->fecha_cita : null,
                        'estado' => $notificacion->cita ? $notificacion->cita->estado : null,
                    ]
                );
            })->toArray();
        } elseif (Auth::guard('negocio')->check()) {
            // Notificaciones de negocio
            $notificaciones = notificacion::with('cita')->where('estado', 'Pendiente')->get()->map(function ($notificacion) {
                return array_merge(
                    $notificacion->toArray(),
                    [
                        'fecha' => $notificacion->cita ? $notificacion->cita->fecha_cita : null,
                        'estado' => $notificacion->cita ? $notificacion->cita->estado : null,
                    ]
                );
            })->toArray();
        } else {
            $notificaciones = [];
        }
        $idNegocio = Auth::guard('negocio')->user()->id_negocio;
        $Staff_admin = Staff::where('id_negocio', $idNegocio)
            ->where('id_rol', 1)
            ->with(['usuario', 'rol'])
            ->get();

        foreach ($Staff_admin as $Staff) {
            if ($Staff->usuario && $Staff->usuario->img_usuario) {
                $imgStaff = 'data:image/png;base64,' . base64_encode($Staff->usuario->img_usuario);
            } else {
                $imgStaff = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
            }
        }
        return compact('notificaciones', 'imgStaff');
    }

/*  INSERCION DE UN ESTABLECIMIENTO   */

    public function handleAddEstablecimiento(Request $request){

      //  Log::info('Entrando a handleAddEstablecimiento');
      //  Log::info('Datos recibidos:', $request->all());

        // Validación automática con redirección si falla
        $validated = $request->validate([
            'idEstablc' => 'required|numeric|unique:establecimiento,id_establc',
            'nombreEst' => 'required|string|max:30',
            'direccionEstablecimiento' => 'required|string|max:30',
            'descripcionEstablecimiento' => 'required|string',
            'telefonoEstablecimiento' => 'required|numeric|unique:establecimiento,telefono',
            'correoEstablecimiento' => 'required|email:rfc,dns|unique:establecimiento,correo'
        ], [
            'idEstablc.required' => 'El nit del establecimiento es obligatorio',
            'idEstablc.numeric' => 'El nit del establecimiento debe ser un número',
            'idEstablc.unique' => 'El nit de este establecimiento ya se encuentra registrado',

            'nombreEst.required' => 'El nombre del establecimiento es obligatorio',
            'nombreEst.string' => 'El nombre del establecimiento debe ser solo texto',
            'nombreEst.max' => 'El nombre no puede superar los 30 caracteres',

            'direccionEstablecimiento.required' => 'La dirección es obligatoria',
            'direccionEstablecimiento.max' => 'La dirección no puede superar los 30 caracteres',

            'descripcionEstablecimiento.required' => 'La descripción es obligatoria',
            'descripcionEstablecimiento.string' => 'La descripción debe ser solo texto',

            'telefonoEstablecimiento.required' => 'El teléfono es obligatorio',
            'telefonoEstablecimiento.numeric' => 'El teléfono debe contener solo números',
            'telefonoEstablecimiento.unique' => 'Este número de teléfono ya está registrado en otro establecimiento',

            'correoEstablecimiento.required' => 'El correo es obligatorio',
            'correoEstablecimiento.email' => 'El correo electrónico no tiene un formato válido',
            'correoEstablecimiento.unique' => 'Este correo ya se encuentra registrado en otro establecimiento'
        ]);

        // Log::info("Validación exitosa, creando el establecimiento.");

        $idNegocio = Auth::guard('negocio')->user()->id_negocio;
        $negocio = Negocio::find($idNegocio);
        $id_usuario = $negocio->id_usuario;

        // Crear el establecimiento
        Establecimiento::create([
            'id_establc' => $validated['idEstablc'],
            'id_negocio' => $idNegocio,
            'nombre_establc' => $validated['nombreEst'],
            'ubicacion' => $validated['direccionEstablecimiento'],
            'desc_establc' => $validated['descripcionEstablecimiento'],
            'telefono' => $validated['telefonoEstablecimiento'],
            'correo' => $validated['correoEstablecimiento'],
            'valoracion_final' => 0.0
        ]);

        // Crear el staff asociado
        Staff::create([
            'id_usuario' => $id_usuario,
            'id_establc' => $validated['idEstablc'],
            'id_negocio' => $idNegocio,
            'id_rol' => 1
        ]);

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

        if($accion === 'register'){
            //Log::info('Cargando vista de registro desde el controlador');
            $registerEstablecimiento = GlobalVariables::$registerEstablecimiento;
            return view($registerEstablecimiento);
        }
        if($accion === 'config'){
            $configEstablecimiento = GlobalVariables::$configEstablecimiento;
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $establecimiento = Establecimiento::where('id_negocio', $idNegocio)->first();
            return view($configEstablecimiento,[
                'establecimiento' => $establecimiento,
                'idNegocio' => $idNegocio
            ]+ $this->notificacionUsuario());
        }
    }
}
