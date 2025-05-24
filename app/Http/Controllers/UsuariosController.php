<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Hash;
use App\Models\Establecimiento;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Cita;
use App\Models\ReservaServicio;
use App\Models\ReservaProducto;
use App\Models\notificacion;
use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\Valoracion;
use App\Models\Negocio;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB as FacadesDB;

/*INDEX USUARIO DE MYLOOK */

class UsuariosController extends Controller
{
    //Clase privada para las variables necesarios de indexUsuario
    private function indexUsuario()
    {
        $establecimientosAleatorios = Establecimiento::with('negocio')
            ->inRandomOrder()
            ->take(5)
            ->get()
            ->toArray();
        $mejoresEstablecimientos = Establecimiento::with('negocio')
            ->select(
                'establecimiento.id_establc',
                'establecimiento.id_negocio',
                'establecimiento.nombre_establc',
                'establecimiento.desc_establc',
                DB::raw('AVG(valoracion.calificacion) as promedio_calificacion')
            )
            ->join('cita', 'establecimiento.id_establc', '=', 'cita.id_establc')
            ->join('valoracion', 'cita.id_cita', '=', 'valoracion.id_cita')
            ->groupBy(
                'establecimiento.id_establc',
                'establecimiento.id_negocio',
                'establecimiento.nombre_establc',
                'establecimiento.desc_establc'
            )
            ->orderByDesc(DB::raw('promedio_calificacion'))
            ->take(3)
            ->get();

        $establecimientosRecomendados = Establecimiento::with('negocio')
            ->inRandomOrder()
            ->take(6)
            ->get();
        $idusuario = Auth::guard('usuario')->user()->id_usuario;
        $imgusuario = Usuario::where('id_usuario', $idusuario)->value('img_usuario');
        if ($imgusuario) {
            $imgusuario = 'data:image/png;base64,' . base64_encode($imgusuario);
        } else {
            $imgusuario = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
        }
        return compact(
            'establecimientosAleatorios',
            'mejoresEstablecimientos',
            'establecimientosRecomendados',
            'imgusuario'
        );
    }

        private function index()
    {
        $establecimientosAleatorios = Establecimiento::with('negocio')
            ->inRandomOrder()
            ->take(5)
            ->get()
            ->toArray();
        $mejoresEstablecimientos = Establecimiento::with('negocio')
            ->select(
                'establecimiento.id_establc',
                'establecimiento.id_negocio',
                'establecimiento.nombre_establc',
                'establecimiento.desc_establc',
                DB::raw('AVG(valoracion.calificacion) as promedio_calificacion')
            )
            ->join('cita', 'establecimiento.id_establc', '=', 'cita.id_establc')
            ->join('valoracion', 'cita.id_cita', '=', 'valoracion.id_cita')
            ->groupBy(
                'establecimiento.id_establc',
                'establecimiento.id_negocio',
                'establecimiento.nombre_establc',
                'establecimiento.desc_establc'
            )
            ->orderByDesc(DB::raw('promedio_calificacion'))
            ->take(3)
            ->get();

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
    //Clase privada para las notificaciones
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
            $imgusuario = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
        }
        return compact('notificaciones','imgusuario');
    }
    //------------------------------------------------------------------------------------------------------------------------------
    public function crudUsuarios(Request $request, $accion = null)
    {
        $registerUserView = GlobalVariables::$registerUserView;
        $indexUsuarioView = GlobalVariables::$indexUsuarioView;
        $agendamientoView = GlobalVariables::$agendamientoView;
        $configUsersView = GlobalVariables::$configUsersView;
        $agendamientoEstablecimiento = GlobalVariables::$agendamientoEstablecimiento;
        $viewHistorial = GlobalVariables::$viewHistorial;
        // Clase privada para datos necesarios para funcionar nuevamente la vista indexUsuario:

        if ($accion === 'index') {
            return view($indexUsuarioView, ($this->indexUsuario() + $this->notificacionUsuario()));
        } elseif ($accion === 'verMas') {
            //Campos necesarios para cargar los datos necesarios del ver mas de un establecimiento
            $id = $request->input('id_establecimiento');
            $establecimiento = Establecimiento::where('id_establc', $id)
                ->with('negocio')
                ->firstOrFail();
            $negocio =  $establecimiento->negocio;
            $staffs = staff::where('id_establc', $id)->with('usuario', 'rol')->distinct()->get();
            $productos = Producto::where('id_establc', $id)->get()->toArray();
            $categorias = Categoria::where('id_establc', $id)->get()->toArray();
            $valoraciones = Valoracion::with([
                'cita' => function ($query) use ($id) {
                    $query->where('id_establc', $id)
                        ->with('usuario');
                }
            ])->get()->toArray();

            if (isset($negocio['img_perfil']) && isset($negocio['img_portada'])) {
                $negocio['img_perfil'] = 'data:image/png;base64,' . base64_encode($negocio['img_perfil']);
                $negocio['img_portada'] = 'data:image/png;base64,' . base64_encode($negocio['img_portada']);
            }

            foreach ($staffs as $staff) {
                if (isset($staff->usuario->img_usuario)) {
                    $staff->usuario->img_usuario = 'data:image/png;base64,' . base64_encode($staff->usuario->img_usuario);
                }
            }

            foreach ($productos as &$producto) {
                if (isset($producto['img_prod'])) {
                    $producto['img_prod'] = 'data:image/png;base64,' . base64_encode($producto['img_prod']);
                }
            }
            foreach ($categorias as &$categoria) {
                if (isset($categoria['imagen'])) {
                    $categoria['imagen'] = 'data:image/png;base64,' . base64_encode($categoria['imagen']);
                }
            }
            $idEstablecimiento = $request->input('id_establecimiento'); // Asegúrate de recibir este ID desde la vista o la URL

            $valoraciones = Valoracion::with('cita.usuario')
                ->whereHas('cita', function ($query) use ($idEstablecimiento) {
                    $query->where('id_establc', $idEstablecimiento);
                })
                ->get();

            foreach ($valoraciones as $valoracion) {
                $usuario = $valoracion->cita?->usuario;

                if ($usuario && $usuario->img_usuario) {
                    $base64Data = base64_encode($usuario->img_usuario);
                    $usuario->imagen_base64 = 'data:image/png;base64,' . $base64Data;
                } elseif ($usuario) {
                    $usuario->imagen_base64 = null;
                }
            }


            $idusuario = Auth::guard('usuario')->user()->id_usuario;
            $imgusuario = Usuario::where('id_usuario', $idusuario)->value('img_usuario');
            if ($imgusuario) {
                $imgusuario = 'data:image/png;base64,' . base64_encode($imgusuario);
            } else {
                $imgusuario = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
            }


            return view($agendamientoView, compact('establecimiento', 'productos', 'negocio', 'staffs', 'categorias', 'valoraciones', 'imgusuario') + $this->notificacionUsuario());
        } elseif ($accion === 'register') {
            $id = Auth::guard('usuario')->user()->id_usuario;
            $usuario = Usuario::findOrFail($id);
            return view($registerUserView, compact(('usuario')));
        } elseif ($accion === 'config') {
            $id = session('usuario_id');
            $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
            return view($configUsersView, compact('usuario') + $this->notificacionUsuario());
           
        } elseif ($accion === 'agendar') {
            // Variables que se necesita para luego crear una cita
            $idEstablecimiento = $request->input('id_establecimiento');
            $idUsuario = Auth::guard('usuario')->user()->id_usuario;
            $productos = Producto::where('id_establc', $idEstablecimiento)
                ->select('id_prod', 'nombre_prod', 'stock', 'img_prod')
                ->get()
                ->map(function ($producto) {
                    if (!empty($producto->img_prod)) {
                        $producto->img_prod = 'data:image/jpeg;base64,' . base64_encode($producto->img_prod);
                    } else {
                        $producto->img_prod = 'https://via.placeholder.com/150'; // Imagen por defecto si no existe
                    }
                    return $producto;
                })
                ->toArray();
            $staffs = Staff::where('id_establc', $idEstablecimiento)
                ->where('estado', 'disponible')
                ->where('id_rol', '!=', 1)
                ->with('usuario') // Cargar relación con el modelo Usuario
                ->get()
                ->map(function ($staff) {
                    if (!empty($staff->usuario->img_usuario)) {
                        $staff->imagen = 'data:image/jpeg;base64,' . base64_encode($staff->usuario->img_usuario);
                    } else {
                        $staff->imagen = 'https://via.placeholder.com/150'; // Imagen por defecto si no existe
                    }
                    return [
                        'id_staff' => $staff->id_staff,
                        'nombre' => $staff->usuario->nombre, // Tomar el nombre del usuario
                        'imagen' => $staff->imagen
                    ];
                })
                ->toArray();
            $categorias = Categoria::where('id_establc', $idEstablecimiento)->get()->toArray();
            $servicios = Servicio::all();

            // arreglo para fullCalendar
            $citas = Cita::where('id_establc', $idEstablecimiento)
                ->whereIn('estado_cita', ['aceptado', 'pendiente'])
                ->get();
            $arreglo = []; // Inicializar el arreglo vacío antes de recorrerlo
            foreach ($citas as $cita) {
                $fecha_citas = $cita->fecha_cita;
                $hora_citas = $cita->hora_cita;
                $start = "{$fecha_citas}T{$hora_citas}";

                $arreglo[] = [
                    'title' => 'ocupado',
                    'start' => $start,
                    'color' => '#A68160',
                ];
            }

            $idusuario = Auth::guard('usuario')->user()->id_usuario;
            $imgusuario = Usuario::where('id_usuario', $idusuario)->value('img_usuario');
            if ($imgusuario) {
                $imgusuario = 'data:image/png;base64,' . base64_encode($imgusuario);
            } else {
                $imgusuario = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
            }


            return view($agendamientoEstablecimiento, compact('idEstablecimiento', 'idUsuario', 'productos', 'staffs', 'categorias', 'servicios', 'arreglo', 'imgusuario') + $this->notificacionUsuario());
        } elseif ($accion === 'agendamiento') {
            //Variables necesarias para crear una cita, reserva servicio y opcional reserva producto
            $idEstablecimiento = $request->input('id_establecimiento');
            $idUsuario = $request->input('id_usuario');
            $estado = $request->input('estado'); // Siempre llegara como pendiente
            $fecha = $request->input('fecha');
            $hora = $request->input('hora');
            $idStaff = $request->input('idStaff');
            $idCategoria = $request->input('idCategoria');
            $idServicio = $request->input('idServicio');
            $duracion = Servicio::where('id_servicio', $idServicio)->pluck('duracion_serv')->first();
            //Opcional Producto y cantidad
            $idProducto = $request->input('idProducto');
            $cantidadProducto = $request->input('cantidadProducto');

            if (
                isset($idEstablecimiento) && isset($idUsuario) && isset($estado)
                && isset($fecha) && isset($hora) && isset($idStaff) && isset($idCategoria)
                && isset($idServicio)
            ) {
                // Verifica si llegan todas las variables necesarios para una cita sin productos
                $cita = cita::create([
                    'id_usuario' => $idUsuario,
                    'id_establc' => $idEstablecimiento,
                    'id_staff' => $idStaff,
                    'fecha_cita' => $fecha,
                    'hora_cita' => $hora,
                    'duracion_cita' => $duracion,
                    'estado_cita' => $estado
                ]);
                $idCita = $cita->id_cita;

                $reserva_servicio = ReservaServicio::create([
                    'id_cita' => $idCita,
                    'id_servicio' => $idServicio
                ]);

                //Crea la notificacion para el establecimiento
                $notificacion = notificacion::create([
                    'id_cita' => $idCita,
                    'titulo' => 'Solicitud de servicio',
                    'estado' => 'Pendiente'
                ]);

                // Si selecciona un producto y cantidad crea tambien reserva_producto
                if (isset($idProducto) && isset($cantidadProducto)) {
                    $reserva_producto = ReservaProducto::create([
                        'id_cita' => $idCita,
                        'id_prod' => $idProducto,
                        'cantidad' => $cantidadProducto
                    ]);
                    //Elimina provicional los productos solicitados
                    $producto = Producto::find($idProducto);
                    if ($producto) {
                        if ($producto->stock >= $cantidadProducto) {
                            $producto->stock -= $cantidadProducto;
                        } else {
                            $producto->stock = 0;
                        }
                        $producto->save();
                    }
                }

                return view($indexUsuarioView, ($this->indexUsuario() + $this->notificacionUsuario()));
            }
        } elseif ($accion === 'historialCitas') {
            $idusuario = Auth::guard('usuario')->user()->id_usuario;
            $HistorialCitas = Cita::with('staff.usuario', 'usuario', 'establecimiento')
                ->where('id_usuario', $idusuario)
                ->get()
                ->toArray();
            $idusuario = Auth::guard('usuario')->user()->id_usuario;
            $imgusuario = Usuario::where('id_usuario', $idusuario)->value('img_usuario');
            if ($imgusuario) {
                $imgusuario = 'data:image/png;base64,' . base64_encode($imgusuario);
            } else {
                $imgusuario = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
            }
            return view($viewHistorial, compact('HistorialCitas', 'imgusuario') + $this->notificacionUsuario());
        } elseif ($accion === 'logout') {
            Auth::guard('usuario')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $indexView = GlobalVariables::$indexView;
            return view($indexView, $this->index());
        } else {
            return redirect()->route('usuarios', ['accion' => 'index']);
        }
    }

    /*  ACTUALIZACION DE UN USUARIO DESPUES DE REGISTRARSE  */
    public function userUpdate(Request $request)
    {
        // Aqui se validan los datos que provienen del formulario de perfil usuario
        $request->validate([
            'idUser' => 'required|numeric|exists:usuario,id_usuario',
            'nombreUser' => 'required|string|max:30',
            'apellidoUser' => 'required|string|max:30',
            'correoUser' => 'required|email|unique:usuario,correo,' . $request->idUser . ',id_usuario',
            'telefonoUser' => 'required|string|max:30|unique:usuario,telefono,' . $request->idUser . ',id_usuario',
            'imagenPerfil' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'condicionUser' => 'nullable|String|'
        ], [
            'idUser.required' => 'El documento del usuario es obligatorio',
            'idUser.numeric' => 'El documento debe ser un número',
            'idUser.unique' => 'Este documento ya está registrado',

            'nombreUser.required' => 'El nombre es obligatorio',
            'nombreUser.string' => 'El nombre debe ser texto',
            'nombreUser.max' => 'El nombre no debe exceder los 30 caracteres',

            'apellidoUser.required' => 'El apellido es obligatorio',
            'apellidoUser.string' => 'El apellido debe ser texto',
            'apellidoUser.max' => 'El apellido no debe exceder los 30 caracteres',

            'correoUser.required' => 'El correo es obligatorio',
            'correoUser.email' => 'El formato del correo no es válido',
            'correoUser.unique' => 'Este correo ya está registrado',

            'telefonoUser.required' => 'El teléfono es obligatorio',
            'telefonoUser.unique' => 'Este teléfono ya está registrado',
            'telefonoUser.max' => 'El teléfono no debe exceder los 30 caracteres',

            'imagenPerfil.image' => 'El archivo debe ser una imagen',
            'imagenPerfil.mimes' => 'La imagen debe ser de tipo: jpg, jpeg, png, gif o webp',
            'imagenPerfil.max' => 'La imagen no debe pesar más de 5 MB',
        ]);
        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla en la tabla si no dejara el campo como null
        $img_usuario = null;
        if ($request->hasFile('imagenPerfil')) {
            $img = $request->file('imagenPerfil');
            $img_usuario = file_get_contents($img->getRealPath());
        };
        $usuario = Usuario::find(Auth::guard('usuario')->user()->id_usuario);
        $usuario->update([
            'nombre' => $request->nombreUser,
            'apellido' => $request->apellidoUser,
            'correo' => $request->correoUser,
            'telefono' => $request->telefonoUser,
            'img_usuario' => $img_usuario,
            'condicion' => $request->condicionUser,
        ]);
        return redirect()->route('usuarios', ['accion' => 'index']);
    }


    public function handleUpdateUsers(Request $request, $id)
    {


        $usuario = Usuario::where('id_usuario', $id)->firstOrFail();

        $usuario->nombre = $request->input('nombreUsuario');
        $usuario->apellido = $request->input('apellidoUsuario');
        $usuario->correo = $request->input('correoUsuario');
        $usuario->id_usuario = $request->input('documentoUsuario');
        $usuario->telefono = $request->input('telefonoUsuario');
        $usuario->condicion = $request->input('condicionUsuario');

        if ($request->hasFile('imagenPerfil') && $request->file('imagenPerfil')->isValid()) {
            $usuario->img_usuario = file_get_contents($request->file('imagenPerfil')->getRealPath());
        }

        $usuario->save();

        return redirect()->route('usuarios', ['accion' => 'index']);
    }
}
