<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Establecimiento;
use App\Models\notificacion;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;
use Carbon\Carbon;

class StaffController extends Controller
{
    //Clase privada para las notificaciones
private function notificacionUsuario(){
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

    public function getStaff()
    {
        $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
        return view('Formularios.Login.registerStaff', compact('roles'));

    }
    /* INSERCIÓN DE STAFF */

    public function handleAddStaff(Request $request)
    {
        //obtener foraneas
        $idNegocio = Auth::guard('negocio')->user()->id_negocio;
        $idEstablecimiento = Establecimiento::where('id_negocio', $idNegocio)->value('id_establc');

        // Obtener los datos del request
        $documentoStaff = $request->input('documentoStaff');
        $nombreCompletoStaff = $request->input('nombreCompletoStaff');
        $apellidoStaff = $request->input('apellidoStaff');
        $correoStaff = $request->input('correoStaff');
        $contrasenaStaff = password_hash($request->input('contrasena'), PASSWORD_BCRYPT);
        $telefonoStaff = $request->input('telefonoStaff');
        $rolStaff = $request->input('tipoRol');
        $file = $request->file('imagenStaff');
        $imagen = $file ? file_get_contents($file->getRealPath()) : null;
        // Crear el Usuario asociado al Staff
        $usuario = Usuario::create([
            'id_usuario' => $documentoStaff,
            'nombre' => $nombreCompletoStaff,
            'apellido' => $apellidoStaff,
            'contrasena' => $contrasenaStaff,
            'telefono' => $telefonoStaff,
            'correo' => $correoStaff,
            'img_usuario' => $imagen
        ]);

        // Crear la relacion Staff-Usuario
        Staff::create([
            'id_usuario' => $documentoStaff,
            'id_establc' => $idEstablecimiento,
            'id_negocio' => $idNegocio,
            'id_rol' => $rolStaff,
            'estado' => 'disponible',

        ]);
        return redirect()->route('admin');

    }

    /* ACTUALIZACIÓN DE STAFF */
    public function edit($id)
    {
        $staff = Staff::findOrFail($id); // Buscar el miembro del staff por ID
        $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
        return view('Formularios.Login.registerStaff', compact('staff', 'roles'));
    }

    public function handleUpdateStaff(Request $request, $id)
    {

        if ($request->has('editStaff')) {
            $staff = Staff::findOrFail($id);
            $usuario = $staff->usuario;

            $usuario->nombre = $request->input('nombreCompletoStaff');
            $usuario->apellido = $request->input('apellidoStaff');
            $usuario->correo = $request->input('correoStaff');
            $usuario->telefono = $request->input('telefonoStaff');
            if ($request->filled('contrasena')) {
                $usuario->contrasena = password_hash($request->input('contrasena'), PASSWORD_BCRYPT);
            }
            if ($request->hasFile('imagenStaff') && $request->file('imagenStaff')->isValid()) {
                $usuario->img_usuario = file_get_contents($request->file('imagenStaff')->getRealPath());
            }
            $usuario->save();
            $staff->id_rol = $request->input('tipoRol');
            $staff->save();
        }
        return redirect()->route('admin');
    }

    /* ELIMINACION DE STAFF */

    public function handleDeleteStaff(Request $request)
    {

        $id = $request->input('deleteButton');

        $staff = Usuario::where('id_usuario', $id)->first();

        if ($staff) {

            $staff->id_rol = 1;
            $staff->save();
        }
        return redirect()->route('admin');
    }

    public function crudStaff(Request $request, $accion = null)
    {

        $viewCrudStaff = GlobalVariables::$viewCrudStaff;
        $indexStaff = GlobalVariables::$indexStaff;
        $registerStaff = GlobalVariables::$registerStaff;
        $viewstaff = GlobalVariables::$viewstaff;
        $InicioSessionStaff = GlobalVariables::$InicioSessionStaff;

        if ($accion === 'index') {
            $documentoStaff = Auth::guard('usuario')->user()->id_usuario;
            $staff = staff::with('establecimiento', 'usuario')->where('id_usuario', $documentoStaff)->first();

            if ($staff && $documentoStaff == $staff->id_usuario) {
                $id_staff = $staff->id_staff;

                $ahora = Carbon::now('America/Bogota');

                $citasProximas = cita::with('staff.usuario', 'usuario', 'reservaServicio.servicio', 'establecimiento')
                    ->where('id_staff', $id_staff)
                    ->where(function ($query) use ($ahora) {
                        $query->where('fecha_cita', '>', $ahora->toDateString())
                            ->orWhere(function ($q) use ($ahora) {
                                $q->where('fecha_cita', $ahora->toDateString())
                                    ->where('hora_cita', '>=', $ahora->format('H:i:s'));
                            });
                    })
                    ->orderBy('fecha_cita', 'asc')
                    ->orderBy('hora_cita', 'asc')
                    ->take(4)
                    ->get();
                // Todas las citas (para el calendario), sin filtro de fecha
                $todasLasCitas = cita::with('staff.usuario', 'usuario', 'reservaServicio.servicio', 'establecimiento')
                    ->where('id_staff', $id_staff)
                    ->whereIn('estado_cita',['aceptado','pendiente'])
                    ->orderBy('fecha_cita', 'asc')
                    ->orderBy('hora_cita', 'asc')
                    ->get();

                // Función para transformar citas a formato calendario
                $transformarCitas = function ($citas) {
                    $resultado = [];
                    foreach ($citas as $cita) {
                        $fechaInicio = date('Y-m-d\TH:i:s', strtotime($cita->fecha_cita . ' ' . $cita->hora_cita));
                        $fechaFin = date('Y-m-d\TH:i:s', strtotime($cita->fecha_cita . ' ' . $cita->hora_cita) + ($cita->duracion_cita * 60));

                        $resultado[] = [
                            'title' => $cita->reservaServicio->servicio->nombre_servicio,
                            'start' => $fechaInicio,
                            'end' => $fechaFin,
                            'color' => '#a68160',
                            'empleado' => $cita->staff->usuario->nombre,
                            'usuario' => $cita->usuario->nombre,
                            'establecimiento' => $cita->establecimiento->nombre_establc,
                            'estado' => $cita->estado_cita,
                            'id_cita' => $cita->id_cita,
                            'servicio' => $cita->reservaServicio->servicio->nombre_servicio
                        ];
                    }
                    return $resultado;
                };

                $arregloProximas = $transformarCitas($citasProximas);
                $arregloTodas = $transformarCitas($todasLasCitas);

                // Imagen del usuario
                $idusuario = Auth::guard('usuario')->user()->id_usuario;
                $imgusuario = Usuario::where('id_usuario', $idusuario)->value('img_usuario');
                if ($imgusuario) {
                    $imgusuario = 'data:image/png;base64,' . base64_encode($imgusuario);
                } else {
                    $imgusuario = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
                }

                return view($indexStaff, compact('arregloProximas', 'arregloTodas', 'imgusuario', 'staff') + $this->notificacionUsuario());
            } else {
                dd("Este usuario no es administrador");
            }
        } elseif ($accion === 'register') {
            $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
            return view($registerStaff, compact('roles')+ $this->notificacionUsuario());
        } elseif ($accion === 'editar' && $request->has('editStaff')) {
            $id = $request->input('editStaff');
            // Obtener usuario y staff relacionado
            $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
            $staff = Staff::where('id_usuario', $id)->firstOrFail();
            // Codificar imagen
            $imgBase64 = 'data:image/png;base64,' . base64_encode($usuario->img_usuario);
            // Roles para el select
            $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
            $modeValidator = 1;
            return view($viewCrudStaff, compact('staff', 'usuario', 'roles', 'modeValidator', 'imgBase64') + $this->notificacionUsuario());
        } elseif ($accion === 'ver') {

            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $establecimiento = Establecimiento::where('id_negocio', $idNegocio)->pluck('id_establc');
            $infoStaff = Staff::whereIn('id_establc', $establecimiento)
                ->where('id_rol', '!=', 1)
                ->with(['usuario', 'rol'])
                ->get()
                ->toArray();

            foreach ($infoStaff as &$staff) {
                if (isset($staff['usuario']['img_usuario'])) {
                    $staff['usuario']['img_usuario'] = 'data:image/png;base64,' . base64_encode($staff['usuario']['img_usuario']);
                }
            }
            return view($viewstaff, compact('infoStaff'));

        } elseif ($accion === 'eliminar' && $request->has('deleteStaff')) {
            // Se recibe el id del staff
            $id = $request->input('deleteStaff');

            Staff::where('id_usuario', $id)->delete();
            Usuario::where('id_usuario', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');
            // Rutas provicional, para el fronted
        } else {
            return redirect()->route('staff', ['accion' => 'index']);
        }
    }
}