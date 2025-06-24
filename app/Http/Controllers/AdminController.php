<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Establecimiento;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Negocio;
use App\Models\Staff;
use App\Models\Cita;
use App\Models\notificacion;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        ->orderBy('id_staff', 'desc')
        ->get()
        ->take(3)
        ->toArray();

    foreach ($infoStaff as &$staff) {
        if (isset($staff['usuario']['img_usuario'])) {
            $staff['usuario']['img_usuario'] = 'data:image/png;base64,' . base64_encode($staff['usuario']['img_usuario']);
        }
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


    $lascitas = Cita::with('staff.usuario', 'usuario', 'reservaServicio.servicio', 'establecimiento', 'reservaProducto.producto')
        ->whereIn('id_establc', $establecimiento)
        ->whereIn('estado_cita',['aceptado','pendiente'])
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
    return compact('categorias', 'productsPreview', 'infoStaff', 'arreglo', 'imgStaff');

    }
    //Clase privada para las notificaciones
    private function notificacionUsuario(){
        if (Auth::guard('usuario')->check()) {
            // Notificaciones de usuario
            $id_usuario = Auth::guard('usuario')->user()->id_usuario;
            $notificaciones = Notificacion::with('cita')
            ->whereHas('cita', function ($query) use ($id_usuario) {
                $query->where('id_usuario', $id_usuario);
            })
            ->whereIn('estado', ['Aceptado', 'Cancelado'])
            ->get()
            ->map(function ($notificacion) {
                return array_merge(
                    $notificacion->toArray(),
                    [
                        'fecha' => $notificacion->cita ? $notificacion->cita->fecha_cita : null,
                        'estado' => $notificacion->cita ? $notificacion->cita->estado : null,
                    ]
                );
            })
            ->toArray();
        }elseif (Auth::guard('negocio')->check()) {
        // Notificaciones de negocio
        $idNegocio = Auth::guard('negocio')->user()->id_negocio;
        //con el establecimiento consulto
        $establecimiento = Establecimiento::where('id_negocio', $idNegocio)->pluck('id_establc');
        $notificaciones = Notificacion::with('cita')
            ->whereIn('id_cita', function ($query) use ($establecimiento) {
            $query->select('id_cita')
            ->from('cita')
            ->whereIn('id_establc', $establecimiento);
        })
        ->where('estado', 'Pendiente')
        ->get()
        ->map(function ($notificacion) {


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
        return compact('notificaciones');
    }

/*  INSERCION DE UN USUARIO ADMIN   */

    public function handleAddUserAdmin(Request $request){
        $registerAdminView = GlobalVariables::$registerAdminView;
        $configNegocio = GlobalVariables::$registerNegocio;

        // Aqui se validan los datos que provienen del formulario de perfil administrador
        $validator = Validator::make($request->all(), [
            'idAdmin' => 'required|numeric|unique:usuario,id_usuario',
            'nombreAdmin' => 'required|string|max:30',
            'apellidoAdmin' => 'required|string|max:30',
            'correoAdmin' => 'required|email:rfc,dns|unique:usuario,correo',
            'telefonoAdmin' => 'required|string|unique:usuario,telefono|max:30',
            'contrasenaAdmin' => 'required|string',
            'imagenPerfil' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120'
        ], [
    	    'idAdmin.required' => 'El documento del administrador es obligatorio',
    	    'idAdmin.numeric' => 'El documento debe ser un número',
    	    'idAdmin.unique' => 'Este documento ya se encuentra registrado',

    	    'nombreAdmin.required' => 'El nombre es obligatorio',
    	    'nombreAdmin.max' => 'El nombre no puede superar los 30 caracteres',

            'apellidoAdmin.required' => 'El apellido es obligatorio',
    	    'apellidoAdmin.max' => 'El apellido no puede superar los 30 caracteres',

        	'correoAdmin.required' => 'El correo es obligatorio',
    	    'correoAdmin.email' => 'El correo electrónico no tiene un formato válido',
        	'correoAdmin.unique' => 'Este correo ya se encuentra registrado',

        	'telefonoAdmin.required' => 'El telefono es obligatorio',
    	    'telefonoAdmin.unique' => 'Este telefono ya se encuentra registrado',

    	    'contrasenaAdmin.required' => 'La contraseña es obligatoria',

        	'imagenPerfil.image' => 'El archivo debe ser una imagen',
        	'imagenPerfil.mimes' => 'Solo se permiten imágenes JPG, JPEG, PNG, GIF o WEBP',
    	    'imagenPerfil.max' => 'La imagen no debe superar los 5MB'
        ]);

        // Si hay errores, recarga nuevamente la vista con los errores y datos ingresados
        if ($validator->fails()) {
            return view($registerAdminView, [
                'validationErrors' => $validator->errors(),
                'data' => $request->all()
            ]);
        }

        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla en la tabla si no dejara el campo como null
        $img_usuario = null;
        if ($request->hasFile('imagenPerfil')) {
            $img = $request->file('imagenPerfil');
            $img_usuario = file_get_contents($img->getRealPath());
        };

        // Aqui se crea un nuevo usuario en la tabla falta especificar que es con el rol de administrador
        Usuario::create([
            'id_usuario' => $request->idAdmin,
            'nombre' => $request->nombreAdmin,
            'apellido' => $request->apellidoAdmin,
            'correo' => $request->correoAdmin,
            'telefono' => $request->telefonoAdmin,
            'contrasena' => Hash::make($request->contrasenaAdmin),
            'img_usuario' => $img_usuario
        ]);

        // Aqui se busca el negocio logueado para insertar en el campo id_usuario el documento del admin que se registro
        $negocio = Negocio::find(Auth::guard('negocio')->user()->id_negocio);
        $negocio->update([
            'id_usuario' => $request->idAdmin
        ]);

        return redirect()->route('negocio' ,['accion' => 'register']);

    }

// Aqui se hara la actualizacion del usuario con el rol de administrador

    public function handleUpdateUserAdmin(Request $request, $id){
        // Obtengo el id del negocio logueado para hacer una validacion
        $idNegocio = Auth::guard('negocio')->user()->id_negocio;

        // Aqui hago una consulta en la tabla staff para ver si el usuario esta ligado al negocio logueado y que efectivamente tenga el rol de administrador
        $staffAdmin = Staff::where('id_usuario', $id)
            ->where('id_negocio', $idNegocio)
            ->where('id_rol', 1)
            ->first();

        // Aqui se verifica si el usuario con rol de administrador este registrado en staff y ligado al negocio logueado, si no existe se niega el acceso
        if (!$staffAdmin) {
            abort(403, 'Acceso denegado, solo el administrador puede actualizar datos');
        }

        // Aqui hago la consulta en la tabla usuario con el id
        $usuario = Usuario::findOrFail($id);

        // Aqui se verifican los datos del formulario para posteriormente actualizarlos
        $request->validate([
            'idAdmin' => 'required|numeric|exists:usuario,id_usuario',
            'nombreAdmin' => 'required|string|max:30',
            'apellidoAdmin' => 'required|string|max:30',
            'correoAdmin' => 'nullable|email|unique:usuario,correo,' . $id . ',id_usuario',
            'telefonoAdmin' => 'nullable|string|max:15|regex:/^\d+$/',
            'imagenPerfil' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla y actualizarla en la tabla si no pues se deja la que tiene registrada
        $img_usuario = $usuario->img_usuario;
        if ($request->hasFile('imagenPerfil')) {
            $img_usuario = file_get_contents($request->file('imagenPerfil')->getRealPath());
        };

        // Aqui se hace la actualizacion
        $usuario->update([
            'nombre' => $request->nombreAdmin,
            'apellido' => $request->apellidoAdmin,
            'correo' => $request->correoAdmin,
            'telefono' => $request->telefonoAdmin,
            'img_usuario' => $img_usuario
        ]);
        return redirect()->route('admin', ['accion' => 'index']);
    }


    public function crudAdmin(Request $request, $accion = null)
    {

        $registerView = GlobalVariables::$registerAdminView;

        $loginAdminView = GlobalVariables::$loginAdminView;

        $indexAdminView = GlobalVariables::$indexAdminView;

        $configAdminView = GlobalVariables::$configAdminView;

        $viewHistorialNegocio = GlobalVariables::$viewHistorialNegocio;

        //Paramentros necesarios para cargar el admin


        if ($accion === 'index') {
            // Aqui se actualizan las citas que tengan en su estado aceptadas a finalizadas siempre y cuando el tiempo actual sea mayor al de agendamiento
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $idEstablecimiento = Establecimiento::where('id_negocio',$idNegocio)->pluck('id_establc')->first();
            $now = Carbon::now('America/Bogota')->toDateTimeString();
            DB::table('cita')
                ->where('estado_cita', 'Aceptado')
                ->where('id_establc', $idEstablecimiento)
                ->whereRaw("TIMESTAMPADD(MINUTE, duracion_cita, CONCAT(fecha_cita, ' ', hora_cita)) <= ?", [$now])
                ->update(['estado_cita' => 'Finalizada']);

            // Arriba esta la clase private donde estan todos los paramentros CargarDatos...
            return view($indexAdminView, $this->cargarDatosIndex() + $this->notificacionUsuario());

        } elseif ($accion === 'solicitud') {

            $respuesta = $request->input('resultado'); // Recibe la acción (aceptar/eliminar)
            $idCita = $request->input('id_cita'); // Recibe el ID de la cita

            if ($respuesta === 'aceptar') {
                $cita = Cita::find($idCita);
                if ($cita) {
                    $cita->estado_cita = "Aceptado"; // Cambia estado a 'Aceptado'
                    // Crea una nueva notificacion de aceptado
                    $notificacion = notificacion::create([
                        'id_cita' => $idCita,
                        'titulo' => 'Solicitud de servicio Aceptada',
                        'estado' => 'Aceptado'
                    ]);
                    $notificacion->save();
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
                    $cita->estado_cita = 'Cancelado'; // cambia el estado a 'Cancelado'
                    $notificacion = notificacion::create([
                        'id_cita' => $idCita,
                        'titulo' => 'Solicitud de servicio cancelada',
                        'estado' => 'Cancelado'
                    ]);
                    $notificacion->save();
                    $cita->save();
                } else {
                    // Depuraciones que cambian...
                    return response()->json(['mensaje' => 'Cita no encontrada'], 404);
                }
            }
            // Redirige al index después de la acción
            return redirect()->route('admin', ['accion' => 'index']);



        } elseif ($accion === 'register') {
            return view($registerView);
        } elseif ($accion === 'login') {
            return view($loginAdminView);
        } elseif ($accion === 'config') {
        // Aqui se obtiene el id del negocio para hacer una consulta y obtener los datos del usuario registrado como administrador a travez de la tabla staff
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $staffAdmin = Staff::where('id_negocio', $idNegocio)
                ->where('id_rol', 1)
                ->first();
        // Aqui valida que efectivamente el usuario a travez de la id capturada tenga el rol de administrador
            if (!$staffAdmin || !$staffAdmin->usuario) {
                abort(403, 'Acceso denegado, solo el administrador puede acceder');
            }
        // Aqui se obtiene la imagen almacenada en usuario a travez de la relacion en el modelo
            $fotoAdmin = base64_encode($staffAdmin->usuario->img_usuario);

        // Aqui a travez de la relacion que existe en el modelo obtengo los datos del usuario y se pasan a la vista junto con su imagen decodificada
            return view($configAdminView, $this->notificacionUsuario() +$this->cargarDatosIndex(),[
                'usuarioAdmin' => $staffAdmin->usuario,
                'fotoAdmin' => $fotoAdmin
            ]);
        }
        elseif($accion === 'historial'){
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $idEstablecimiento = Establecimiento::where('id_negocio',$idNegocio)->pluck('id_establc')->first();
            $HistorialCitas = Cita::with('staff.usuario','usuario','establecimiento')
            ->where('id_establc',$idEstablecimiento)
            ->where('estado_cita','Finalizada')
            ->get()
            ->toArray();
            //Imagen del staff en el header
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
            return view($viewHistorialNegocio, compact('HistorialCitas','imgStaff') + $this->notificacionUsuario());
        }
         else {
            return redirect()->route('admin', ['accion' => 'index']);
        }
    }

}
