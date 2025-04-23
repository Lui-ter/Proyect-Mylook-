<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Establecimiento;
use App\Models\Producto;
use App\Models\Staff;
use App\Models\Cita;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // una clase privada  donde estan todos los parametros para que la vista cargue correctamente
    private function cargarDatosIndex()
    {
    $idNegocio = Auth::guard('negocio')->user()->id_negocio;
    $establecimiento = Establecimiento::where('id_negocio', $idNegocio)->pluck('id_establc');
    $categorias = Categoria::where('id_establc', $establecimiento)->get()->toArray();

    $productsPreview = Producto::whereIn('id_establc', $establecimiento)
        ->latest()
        ->take(3)
        ->get();

    foreach ($categorias as &$categoria) {
        if (isset($categoria['imagen'])) {
            $categoria['imagen'] = 'data:image/png;base64,' . base64_encode($categoria['imagen']);
        }
    }

    foreach ($productsPreview as &$productPreview) {
        if (isset($productPreview['img_prod'])) {
            $productPreview['img_prod'] = 'data:image/png;base64,' . base64_encode($productPreview['img_prod']);
        }
    }

    $infoStaff = Staff::whereIn('id_establc', $establecimiento)
        ->where('id_rol', '!=', 1)
        ->with(['usuario', 'rol'])
        ->get()
        ->take(3)
        ->toArray();

    foreach ($infoStaff as &$staff) {
        if (isset($staff['usuario']['img_usuario'])) {
            $staff['usuario']['img_usuario'] = 'data:image/png;base64,' . base64_encode($staff['usuario']['img_usuario']);
        }
    }

    $lascitas = Cita::with('staff.usuario', 'usuario', 'reservaServicio.servicio', 'establecimiento', 'reservaProducto.producto')
        ->whereIn('id_establc', $establecimiento)
        ->get();

    $arreglo = [];

    foreach ($lascitas as $cita) {
        $fechaInicio = date('Y-m-d\TH:i:s', strtotime($cita->fecha_cita . ' ' . $cita->hora_cita));
        $fechaFin = date('Y-m-d\TH:i:s', strtotime($cita->fecha_cita . ' ' . $cita->hora_cita) + ($cita->duracion_cita * 60));

        $arreglo[] = [
            'title' => $cita->reservaServicio->servicio->nombre_servicio,
            'start' => $fechaInicio,
            'end' => $fechaFin,
            'color' => '#28a745',
            'empleado' => $cita->staff->usuario->nombre,
            'usuario' => $cita->usuario->nombre,
            'establecimiento' => $cita->establecimiento->nombre_establc,
            'producto' => $cita->reservaProducto->producto?->nombre_prod ?? 'Sin producto',
            'cantidad' => $cita->reservaProducto->cantidad ?? 'Sin cantidad',
            'estado' => $cita->estado_cita,
            'id_cita' => $cita->id_cita,
        ];
    }

    return compact('categorias', 'productsPreview', 'infoStaff', 'arreglo');

    }


    public function crudAdmin(Request $request, $accion = null)
    {

        $registerView = GlobalVariables::$registerAdminView;

        $loginAdminView = GlobalVariables::$loginAdminView;

        $indexAdminView = GlobalVariables::$indexAdminView;

        $configAdminView = GlobalVariables::$configAdminView;

        //Paramentros necesarios para cargar el admin


        if ($accion === 'index') {
            // Arriba esta la clase private donde estan todos los paramentros CargarDatos...
            return view($indexAdminView, $this->cargarDatosIndex());

        } elseif ($accion === 'solicitud') {

            $respuesta = $request->input('resultado'); // Recibe la acción (aceptar/eliminar)
            $idCita = $request->input('id_cita'); // Recibe el ID de la cita

            if ($respuesta === 'aceptar') {
                $cita = Cita::find($idCita);
                if ($cita) {
                    $cita->estado_cita = "Aceptado"; // Cambia estado a 'Aceptado'
                    $cita->save();

                } else {
                    // Depuraciones que cambian...
                    return response()->json(['mensaje' => 'Cita no encontrada'], 404);
                }
            } elseif ($respuesta === 'eliminar') {
                $cita = Cita::find($idCita);
                if ($cita) {
                    // trae los datos de reserva para mirar cantidad
                    $reserva = $cita->reservaProducto;
                    if ($reserva) {

                        $producto = Producto::find($reserva->id_prod);
                        if ($producto) {
                            $producto->stock += $reserva->cantidad; // Devuelve la cantidad al stock
                            $producto->save(); // Guarda el cambio en la base de datos
                        }
                    }

                    $cita->reservaServicio()?->delete();
                    $cita->reservaProducto()?->delete();
                    $cita->delete();

                } else {
                    // Depuraciones que cambian...
                    return response()->json(['mensaje' => 'Cita no encontrada'], 404);
                }
            }
            // Redirige al index después de la acción
            // Arriba esta la clase private donde estan todos los paramentros CargarDatos...
            return view($indexAdminView, $this->cargarDatosIndex());




        } elseif ($accion === 'register') {
            return view($registerView);
        } elseif ($accion === 'login') {
            return view($loginAdminView);
        } elseif ($accion === 'config') {
            return view($configAdminView);
        } else {
            return redirect()->route('admin', ['accion' => 'index']);
        }
    }

}
