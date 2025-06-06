<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Negocio;
use App\Models\Staff;
use App\Models\Establecimiento;
use Illuminate\Contracts\Session\Session;
use App\Helpers\GlobalVariables;
use App\Models\notificacion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NegociosController extends Controller
{
     private function index()
    {
        $establecimientosAleatorios = Establecimiento::with('negocio')
            ->inRandomOrder()
            ->take(5)
            ->get()
            ->toArray();
        // Obtener los mejores establecimientos ordenados por valoracion_final
        $mejoresEstablecimientos = Establecimiento::with('negocio')
            ->orderByDesc('valoracion_final')
            ->take(3)
            ->get();
        // Asegurarse de que los establecimientos aleatorios no se repitan con los mejores
        $establecimientosRecomendados = Establecimiento::with('negocio')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return compact(
            'establecimientosAleatorios',
            'mejoresEstablecimientos',
            'establecimientosRecomendados',
        );
    }
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

    /* ACTUALIZACIÓN DE NEGOCIO CUANDO SE CREA POR PRIMERA VEZ*/
    public function handleUpdateNegocio(Request $request){
        $configNegocio = GlobalVariables::$registerNegocio;
        // Aqui se validan los datos que provienen del formulario de negocio
        $validator = Validator::make($request->all(), [
            'descripcionNegocio' => 'required|string',
            'img_portada' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'img_logo' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120'
        ],[
            'descripcionNegocio.required' => 'La descripción del negocio es obligatoria',
            'descripcionNegocio.string' => 'La descripción del negocio debe ser solo texto',

            'img_portada.required' => 'La imagen de portada del negocio es obligatoria',
            'img_portada.image' => 'La imagen de portada debe ser un archivo de imagen',
            'img_portada.mimes' => 'La imagen de portada debe tener uno de los siguientes formatos: jpg, jpeg, png, gif, webp.',
            'img_portada.max' => 'La imagen de portada no puede exceder los 5 MB.',

            'img_logo.required' => 'La imagen de perfil del negocio es obligatoria',
            'img_logo.image' => 'La imagen de perfil debe ser un archivo de imagen',
            'img_logo.mimes' => 'La imagen de perfil debe tener uno de los siguientes formatos: jpg, jpeg, png, gif, webp.',
            'img_logo.max' => 'La imagen de perfil no puede exceder los 5 MB.',
        ]);
        // Si hay errores, recarga nuevamente la vista con los errores y datos ingresados
        if ($validator->fails()) {
            $negocio = Negocio::find(Auth::guard('negocio')->user()->id_negocio);
            return view($configNegocio, [
                'negocio' => $negocio,
                'admin' => $negocio->usuario,
                'validationErrors' => $validator->errors(),
                'data' => $request->all()
            ]);
        }
        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla en la tabla si no dejara el campo como null
        $img_portada = null;
        $img_logo = null;
            if($request->hasFile('img_portada')){
                $imgPortada = $request->file('img_portada');
                    $img_portada = file_get_contents($imgPortada->getRealPath());
            };
            if($request->hasFile('img_logo')){
                $imgLogo = $request->file('img_logo');
                $img_logo = file_get_contents($imgLogo->getRealPath());
            }
        // Aqui se actualiza el registro de negocio encontrado a travez de su id
        $negocio = Negocio::find(Auth::guard('negocio')->user()->id_negocio);
        $negocio->update([
            'desc_negocio' => $request->descripcionNegocio,
            'img_portada' => $img_portada,
            'img_perfil' => $img_logo
        ]);
        return redirect()->route('establecimientos', ['accion' => 'register']);
    }

    // ACTUALIZACION DE NEGOCIO DESDE EL PANEL DE ADMINISTRADOR
    public function handleUpdateNegocioTwo(Request $request, $id){
        $negocioData = Negocio::findOrFail($id);
        // Aqui se validan los datos que provienen del formulario de negocio
        $request->validate([
            'id_usuario' => 'required|numeric',
            'nombreNegocio' => 'nullable|string',
            'descripcionNegocio' => 'required|string',
            'img_portada' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'img_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);
        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla en la tabla si no dejara el campo como null
        $img_portada = $negocioData->img_portada;
        $img_logo = $negocioData->img_perfil;
        if($request->hasFile('img_portada')){
            $imgPortada = $request->file('img_portada');
            $img_portada = file_get_contents($imgPortada->getRealPath());
        };
        if($request->hasFile('img_logo')){
            $imgLogo = $request->file('img_logo');
            $img_logo = file_get_contents($imgLogo->getRealPath());
        }
        // Aqui se actualiza el registro de negocio encontrado a travez de su id
        $negocioData->update([
            'nombre_negocio' => $request->nombreNegocio,
            'desc_negocio' => $request->descripcionNegocio,
            'img_portada' => $img_portada,
            'img_perfil' => $img_logo
        ]);
        return redirect()->route('admin', ['accion' => 'index']);
    }

    /* ELIMINACION DE NEGOCIO */
    public function handleDeleteBussiness(Request $request){
        $id = $request->input('deleteButton');
        $negocio = Negocio::where('id_negocio', $id)->first();
        if ($negocio) {
            $negocio->delete();
        }
        return redirect('#');
    }


    public function crudNegocios(Request $request, $accion = null){
        $configNegocio = GlobalVariables::$configNegocioView;
        if($accion === 'config'){
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $negocio = Negocio::where('id_negocio', $idNegocio)->first();
            $img_perfil = 'data:image/png;base64,'. base64_encode($negocio->img_perfil);
            $img_portada = 'data:image/png;base64,' . base64_encode($negocio->img_portada);
            $staffAdmin = Staff::where('id_negocio', $idNegocio)
                ->where('id_rol', 1)
                ->first();
            return view($configNegocio, [
                'negocio' => $negocio,
                'img_perfil' => $img_perfil,
                'img_portada' => $img_portada,
                'staffAdmin' => $staffAdmin->usuario
            ]+ $this->notificacionUsuario());
        }elseif($accion === 'logout'){
            Auth::guard('usuario')->logout();
            $request->session()->invalidate();
            $indexView = GlobalVariables::$indexView;
            return view($indexView, $this->index());
        }else{
            return redirect()->route('admin');
        }
    }
}
