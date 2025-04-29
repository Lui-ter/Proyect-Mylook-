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

class UsuariosController extends Controller
{

    /*INDEX USUARIO DE MYLOOK */

    function showIndexUsuario()
    {
        return view('Index.indexUsuario');
    }

    public function crudUsuarios(Request $request, $accion = null)
    {

        $indexUsuarioView = GlobalVariables::$indexUsuarioView;
        $agendamientoView = GlobalVariables::$agendamientoView;
        $configUsersView = GlobalVariables::$configUsersView;
        $agendamientoEstablecimiento = GlobalVariables::$agendamientoEstablecimiento;

        if ($accion === 'index') {
            $establecimientosAleatorios = Establecimiento::with('negocio')
                ->inRandomOrder()
                ->take(5)
                ->get()
                ->toArray();

            // TOP 3 establecimientos con mejor valoración promedio
            $mejoresEstablecimientos = Establecimiento::with('negocio')
                ->select('establecimiento.id_establc', 'establecimiento.id_negocio', 'establecimiento.nombre_establc', 'establecimiento.desc_establc', DB::raw('AVG(valoracion.calificacion) as promedio_calificacion'))
                ->join('cita', 'establecimiento.id_establc', '=', 'cita.id_establc')
                ->join('valoracion', 'cita.id_cita', '=', 'valoracion.id_cita')
                ->groupBy('establecimiento.id_establc', 'establecimiento.id_negocio', 'establecimiento.nombre_establc', 'establecimiento.desc_establc')
                ->orderByDesc(DB::raw('promedio_calificacion'))
                ->take(3)
                ->get();

                $establecimientosRecomendados = Establecimiento::with('negocio', 'categorias')
                ->inRandomOrder()
                ->take(6)
                ->get(); // ← no usamos toArray() para evitar errores

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
        
            return view($indexUsuarioView, compact('mejoresEstablecimientos', 'establecimientosAleatorios', 'establecimientosRecomendados','notificaciones'));

        } elseif ($accion === 'verMas') {
            //Campos necesarios para cargar los datos necesarios del ver mas de un establecimiento
            $id = $request->input('id_establecimiento');
            $negocios =  Negocio::where('id_negocio',$id)->get()->toArray();
            $establecimiento = Establecimiento::where('id_establc', $id)->first()->toArray(); 
            $staffs = staff::where('id_establc', $id)->with('usuario','rol')->distinct()->get();
            $productos = Producto::where('id_establc', $id)->get()->toArray();
            $categorias = Categoria::where('id_establc', $id)->get()->toArray();
            $valoraciones = Valoracion::with([
                'cita' => function ($query) use ($id) {
                    $query->where('id_establc', $id)
                        ->with('usuario');
                }
            ])->get()->toArray();

            foreach ($negocios as $negocio){
                if(isset($negocio['img_perfil']) && isset($negocio['img_portada'])){
                    $negocio['img_perfil'] = 'data:image/png;base64,' . base64_encode($negocio['img_perfil']);
                    $negocio['img_portada'] = 'data:image/png;base64,' . base64_encode($negocio['img_portada']);
                }
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
            foreach ($valoraciones as &$valoracion) {
                if (isset($valoracion['cita']['usuario']['imagen'])) {
                    $imagenPath = public_path($valoracion['cita']['usuario']['imagen']);

                    if (file_exists($imagenPath)) {
                        $valoracion['cita']['usuario']['imagen_base64'] = 'data:image/png;base64,' . base64_encode(file_get_contents($imagenPath));
                    } else {
                        $valoracion['cita']['usuario']['imagen_base64'] = null;
                    }
                }
            }
            
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

            return view($agendamientoView, compact('establecimiento', 'productos','negocio','staffs', 'categorias', 'valoraciones','notificaciones'));
        
        } elseif ($accion === 'config') {
            $id = session('usuario_id');
            $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
            return view($configUsersView, compact(('usuario')));
            dd($id);

        } elseif ($accion === 'agendar'){
            // Variables que se necesita para luego crear una cita
            $idEstablecimiento = $request->input('id_establecimiento');
            $idUsuario = Auth::guard('usuario')->user()->id_usuario;
            $productos = Producto::where('id_establc', $idEstablecimiento)->get()->toArray();
            $staffs = Staff::where('id_establc', $idEstablecimiento)
               ->where('estado', 'disponible') 
               ->where('id_rol', '!=', 1) 
               ->with('usuario', 'rol')
               ->get();
            $categorias = Categoria::where('id_establc', $idEstablecimiento)->get()->toArray();
            $servicios = Servicio::all();
            return view($agendamientoEstablecimiento, compact('idEstablecimiento','idUsuario','productos','staffs','categorias','servicios'));
        } elseif ($accion === 'agendamiento'){
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
            $cantidadProducto = $request->input('cantidad_producto');
           
            if (isset($idEstablecimiento) && isset($idUsuario) && isset($estado)
            && isset($fecha) && isset($hora) && isset($idStaff) && isset($idCategoria)
            && isset($idServicio)){
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
                if(isset($idProducto) && isset($cantidadProducto)){
                    $reserva_producto = ReservaProducto::create([
                        'id_cita' => $idCita,
                        'id_prod' => $idProducto,
                        'cantidad' => $cantidadProducto
                    ]);
                //Elimina provicional los productos solicitados
                $producto = Producto::find($idProducto);
                if($producto){
                    if ($producto->stock >= $cantidadProducto) {
                        $producto->stock -= $cantidadProducto;
                    } else {
                        $producto->stock = 0;
                    }
                    $producto->save();
                }
                }
                // Datos necesarios para funcionar nuevamente la vista indexUsuario:
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

                return view($indexUsuarioView, compact('mejoresEstablecimientos', 'establecimientosAleatorios', 'establecimientosRecomendados','notificaciones'));
            }else{
                echo "Falta un campo por deligenciar";
            }

        } elseif ($accion === 'logout') {
            Auth::guard('usuario')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $indexView = GlobalVariables::$indexView;
            return view($indexView);
        } else {
            return redirect()->route('usuarios', ['accion' => 'index']);
        }
    }

    /*  INSERCION DE UN USUARIO ADMIN (Falta especificar el rol, en las migraciones no esta unida la tabla rol con usuario)   */

    public function handleAddUser(Request $request)
    {

        // Aqui se validan los datos que provienen del formulario de perfil administrador
        $request->validate([
            'idAdmin' => 'required|numeric|unique:usuario,id_usuario',
            'nombreAdmin' => 'required|string|max:30',
            'apellidoAdmin' => 'required|string|max:30',
            'correoAdmin' => 'nullable|email|unique:usuario,correo',
            'telefonoAdmin' => 'nullable|string|max:30',
            'contrasenaAdmin' => 'required|string',
            'imagenPerfil' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla en la tabla si no dejara el campo como null
        $img_usuario = null;
        if ($request->hasFile('imagenPerfil')) {
            $img = $request->file('imagenPerfil');
            $img_usuario = file_get_contents($img->getRealPath());
        };

        // Aqui se crea un nuevo usuario en la tabla falta especificar que es con el rol de administrador
        $usuario = Usuario::create([
            'id_usuario' => $request->idAdmin,
            'nombre' => $request->nombreAdmin,
            'apellido' => $request->apellidoAdmin,
            'correo' => $request->correoAdmin,
            'telefono' => $request->telefonoAdmin,
            'contrasena' => Hash::make($request->contrasenaAdmin),
            'img_usuario' => $img_usuario
        ]);


        $idNegocio = session('id_negocio');
        $negocioData = Negocio::find($idNegocio);

        // Aqui se guarda los siguientes datos del formulario perfil administrador para poder usarlo en en el formulario de negocio, como es la misma vista entonces se guarda en una sesión
        session([
            'id_usuario' => $usuario->id_usuario,
            'nombreAdmin' => $usuario->nombre,
            'apellidoAdmin' => $usuario->apellido,
            'negocioData' => $negocioData
        ]);
        return response()->json([
            'nombreAdmin' => $usuario->nombre,
            'apellidoAdmin' => $usuario->apellido,
            'id_usuario' => $usuario->id_usuario
        ]);
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

        if ($request->hasFile('fileInput') && $request->file('fileInput')->isValid()) {
            $usuario->img_usuario = file_get_contents($request->file('fileInput')->getRealPath());
        }

        $usuario->save();

        return redirect()->route('usuarios', ['accion' => 'index']);
    }
}
