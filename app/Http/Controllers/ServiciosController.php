<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;
use App\Helpers\GlobalVariables;
use App\Models\notificacion;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class ServiciosController extends Controller
{

     private function notificacionUsuario()
    {
        if (Auth::guard('usuario')->check()) {
            // Notificaciones de usuario
            $notificaciones = Notificacion::with('cita')->where('estado', 'Aceptado')->get()->map(function ($notificacion) {
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
/* INSERCIÓN DE SERVICIO */

    public function handleAddService(Request $request){

        // Aqui se validan los datos que provienen del formulario de servicios
        $request->validate([
            'idCategoria' => 'required|numeric|exists:categoria,id_categoria',
            'nombreServicio' => 'required|string',
            'descripcionServicio' => 'required|string',
            'precioServicio' => 'required|numeric',
            'duracionServicio' => 'required|numeric',
        ]);

        Servicio::create([
            'id_categoria' => $request->idCategoria,
            'nombre_servicio' => $request->nombreServicio,
            'desc_servicio' => $request->descripcionServicio,
            'duracion_serv' => $request->duracionServicio,
            'precio_servicio' => $request->precioServicio
        ]);

        return redirect()->route('servicios', ['accion' => 'ver', 'id' => $request->idCategoria]);

    }

/* ACTUALIZACION DE SERVICIO */

    public function handleUpdateService(Request $request, $id){

        $request->validate([
            'nombreServicio' => 'required|string',
            'descripcionServicio' => 'required|string',
            'precioServicio' => 'required|numeric',
            'duracionServicio' => 'required|numeric',
        ]);

        $servicio = Servicio::where('id_servicio', $id)->firstOrFail();
        $servicio->nombre_servicio = $request->input('nombreServicio');
        $servicio->desc_servicio = $request->input('descripcionServicio');
        $servicio->duracion_serv = $request->input('duracionServicio');
        $servicio->precio_servicio = $request->input('precioServicio');
        $servicio->save();

        return redirect()->route('servicios', ['accion' => 'ver', 'id' => $request->idCategoria]);

    }

/* VIEWS CRUD SERVICIOS */

    function crudServicios(Request $request, $accion = null){

        $viewCrudServicios = GlobalVariables::$viewCrudServicios;
        $viewServicios = GlobalVariables::$viewServicios;

        if ($accion === 'editar' && $request->has('editServicio')) {
            $id = $request->input('editServicio');
            $servicio = Servicio::where('id_servicio', $id)->first();
            $idCategoria = Servicio::where('id_servicio', $id)->value('id_categoria');
            $categorias = Categoria::where('id_categoria', $idCategoria)->first();
            $modeValidator = '1';
            return view($viewCrudServicios, compact('servicio', 'modeValidator', 'categorias')+ $this->notificacionUsuario());

        } elseif ($accion === 'eliminar' && $request->has('deleteServicio')) {
            $id = $request->input('deleteServicio');
            Servicio::where('id_servicio', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');

        } elseif ($accion === 'nuevo') {
            $idCategoria = $request->input('id');
            $categorias = Categoria::where('id_categoria', $idCategoria)->first();
            $modeValidator = '2';
            return view($viewCrudServicios, compact( 'modeValidator', 'categorias')+ $this->notificacionUsuario());

        } elseif ($accion === 'ver') {
            // Aqui se obtiene los datos del negocio logueado para tomar el nombre
            $negocio = Auth::guard('negocio')->user();
            $nombreNegocio = $negocio->nombre_negocio;
            // Aqui se obtiene el id de la categoria para realizar la consulta y asi muestre los servicios relacionados a esa categoria nada mas
            $idCategoria = $request->input('id');
            $categorias = Categoria::where('id_categoria', $idCategoria)->first();
            $categorias['imagen'] = 'data:image/png;base64,' . base64_encode($categorias['imagen']);
            $servicios = Servicio::where('id_categoria', $idCategoria)->get();

            return view($viewServicios, compact('servicios', 'nombreNegocio', 'categorias'));

        }
    }

}
