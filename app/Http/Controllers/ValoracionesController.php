<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\notificacion;
use App\Models\Usuario;
use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValoracionesController extends Controller
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
        $idusuario = Auth::guard('usuario')->user()->id_usuario;
        $imgusuario = Usuario::where('id_usuario', $idusuario)->value('img_usuario');
        if ($imgusuario) {
            $imgusuario = 'data:image/png;base64,' . base64_encode($imgusuario);
        } else {
            $imgusuario = 'https://cdn-user-icons.flaticon.com/146157/146157749/1749352501611.svg?token=exp=1749353412~hmac=084ebaafcb75a5566cbfba6de4b5fd2f';
        }
        return compact('notificaciones', 'imgusuario');
    }

public function showFormValoracion(Request $request)
{
    $idCita = $request->input('id_cita');

    // Traer la cita con el establecimiento y su negocio
    $cita = Cita::with('establecimiento.negocio')->where('id_cita', $idCita)->firstOrFail();

    // Obtener el usuario autenticado
    $usuario = Auth::guard('usuario')->user();

    // Procesar imagen del usuario
    $imgusuario = $usuario->img_usuario;
    if ($imgusuario) {
        $imgusuario = 'data:image/jpeg;base64,' . base64_encode($imgusuario);
    } else {
        $imgusuario = 'https://cdn-user-icons.flaticon.com/146157/146157749/1749352501611.svg?token=exp=1749353412~hmac=084ebaafcb75a5566cbfba6de4b5fd2f';
    }

    // Procesar imágenes del establecimiento
    $establecimiento = $cita->establecimiento;
    $negocio = $establecimiento->negocio;

    $imgPerfil = $negocio?->img_perfil ? 'data:image/jpeg;base64,' . base64_encode($negocio->img_perfil) : 'URL_PREDETERMINADA_IMG_PERFIL';
    $imgPortada = $negocio?->img_portada ? 'data:image/jpeg;base64,' . base64_encode($negocio->img_portada) : 'URL_PREDETERMINADA_IMG_PORTADA';

    return view('Formularios.Insercciones.registerValoraciones', [
        'id_cita' => $idCita,
        'nombre_establecimiento' => $establecimiento->nombre_establc,
        'nombre_usuario' => $usuario->nombre,
        'apellido_usuario' => $usuario->apellido,
        'img_usuario' => $imgusuario,
        'img_establecimiento_perfil' => $imgPerfil,
        'img_establecimiento_portada' => $imgPortada
    ] + $this->notificacionUsuario());
}
    public function handleAddValoracion(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'id_cita' => 'required|exists:cita,id_cita',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:255'
        ]);

        // Obtener los datos del request
        $idCita = $request->input('id_cita');
        $calificacion = $request->input('calificacion');
        $comentario = $request->input('comentario');

        // Crear la valoración
        Valoracion::create([
            'id_cita' => $idCita,
            'calificacion' => $calificacion,
            'comentario' => $comentario
        ]);

        return redirect()->route('usuarios', ['accion' => 'index']);
    }
}
