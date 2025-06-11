<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Establecimiento;
use App\Helpers\GlobalVariables;
use App\Models\notificacion;
use App\Models\Staff;
use App\Models\Servicio;
use App\Models\ReservaServicio;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{
private function notificacionUsuario(){
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
        }elseif (Auth::guard('negocio')->check()) {
        // Notificaciones de negocio
        $notificaciones = Notificacion::with('cita')->where('estado', 'Pendiente')->get()->map(function ($notificacion) {
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
        return compact('notificaciones','imgStaff');
    }
/* LOGICA DE CATEGORIA */

    public function handleAddCategory(Request $request){
        // Aqui se validan los datos que provienen del formulario de categoria
        $request->validate([
            'idEstablecimiento' => 'required|numeric|exists:establecimiento,id_establc',
            'nombreCategoria' => 'required|string',
            'descripcionCategoria' => 'required|string',
            'imgCategoria' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        if($request->hasFile('imgCategoria')){
            $img = $request->file('imgCategoria');
            $imgCategoria = file_get_contents($img->getRealPath());
        };
        // Evita que se dupliquen la misma categoria por un post antiguo
        $existeCategoria = Categoria::where([
            ['id_establc', '=' , $request->idEstablecimiento],
            ['nom_categoria', '=' , $request->nombreCategoria],
            ['desc_categoria', '='  , $request->descripcionCateogira]
        ])->first();

        if($existeCategoria) {
            return redirect()->route('admin',['accion' =>'index']);
        }

        Categoria::create([
            'id_establc' => $request->idEstablecimiento,
            'nom_categoria' => $request->nombreCategoria,
            'desc_categoria' => $request->descripcionCategoria,
            'imagen' => $imgCategoria
        ]);

        return redirect()->route('admin', ['accion' => 'index']);
    }

/* ACTUALIZACION DE CATEGORIA */

    public function handleUpdateCategory(Request $request, $id){

        $request->validate([
            'nombreCategoria' => 'required|string',
            'descripcionCategoria' => 'required|string',
            'imgCategoria' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        $categoria = Categoria::where('id_categoria', $id)->firstOrFail();
        $categoria->nom_categoria = $request->input('nombreCategoria');
        $categoria->desc_categoria = $request->input('descripcionCategoria');
        // Si se selecciono una nueva imagen se guardara en la db, de lo contrario mantendra la imagen que tenia anteriormente
        if($request->hasFile('imgCategoria')){
            $img = $request->file('imgCategoria');
            $imgCategoria = file_get_contents($img->getRealPath());
            $categoria->imagen = $imgCategoria;
        }
        $categoria->save();

        return redirect()->route('admin', ['accion' => 'index']);
    }

    public function crudCategorias(Request $request, $accion = null){

        $viewCategorias = GlobalVariables::$viewCategorias;
        $viewCategorias2 = GlobalVariables::$viewCategorias2;

        if ($accion === 'nuevo') {
            // Se obtiene el id del negocio logueado para sacar el id del establecimiento asociado a ese negocio
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $idEstablecimiento = Establecimiento::where('id_negocio',$idNegocio)->value('id_establc');
            $modeValidator = '2';
            return view($viewCategorias2, compact('modeValidator', 'idEstablecimiento') +  $this->notificacionUsuario());

        } elseif ($accion === 'ver') {
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $establecimiento = Establecimiento::where('id_negocio', $idNegocio)->pluck('id_establc');
            $categorias = Categoria::where('id_establc', $establecimiento)->get()->toArray();


            foreach ($categorias as &$categoria) {
                if (isset($categoria['imagen'])) {
                    $categoria['imagen'] = 'data:image/png;base64,' . base64_encode($categoria['imagen']);
                }
            }
            return view($viewCategorias, compact('categorias')); // Muestra una vista de categorias totalmente diferente

        } elseif ($accion === 'editar' && $request->has('editCategoria')) {
            $id_categoria = $request->input('editCategoria');
            $categoria = Categoria::where('id_categoria', $id_categoria)->first();
            $categoria['imagen'] = 'data:image/png;base64,' . base64_encode($categoria['imagen']);
            $modeValidator = '1';
            return view($viewCategorias2, compact('categoria', 'modeValidator') +  $this->notificacionUsuario());
        }elseif($accion === 'eliminar' && $request->has('deleteCategoria')){
            // Se obtiene el id_categoria para una consulta
            $id_categoria = $request->input('deleteCategoria');
            $categoria = Categoria::find($id_categoria);
            // Aqui se obtienen todos los servicios de la categoría
            $servicios = Servicio::where('id_categoria', $id_categoria)->with('reservas.cita')->get();
            // Se verifican si hay algún servicio con citas pendientes o aceptadas
            foreach ($servicios as $servicio) {
                foreach ($servicio->reservas as $reserva) {
                    if (in_array(strtolower($reserva->cita->estado_cita), ['pendiente', 'aceptado'])) {
                        return redirect()->back()->with('error', 'No se puede eliminar la categoría. Uno o más servicios están en citas activas');
                    }
                }
            }
            // Si no hay servicios con citas pendientes, se elimina la reserva, luego el servicio y luego la categoria
            foreach ($servicios as $servicio) {
                ReservaServicio::where('id_servicio', $servicio->id_servicio)->delete();
                $servicio->delete();
            }
            $categoria->delete();
            return redirect()->back()->with('success', 'Categoría eliminada correctamente.');
        }
    }
}
