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
        return compact('notificaciones');
    }

    /*  INSERCION DE UN USUARIO ADMIN (Falta especificar el rol, en las migraciones no esta unida la tabla rol con usuario)   */

    public function handleAddUserAdmin(Request $request){

        $configNegocio = GlobalVariables::$registerNegocio;

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

        // Aqui se busca el negocio logueado para insertar en el campo id_usuario el documento del admin que se registro
        $negocio = Negocio::find(Auth::guard('negocio')->user()->id_negocio);
        $negocio->update([
            'id_usuario' => $request->idAdmin
        ]);

        return view($configNegocio, [
            'negocio' => $negocio,
            'admin' => $negocio->usuario,
        ]);
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

        //Paramentros necesarios para cargar el admin


        if ($accion === 'index') {
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
            // Arriba esta la clase private donde estan todos los paramentros CargarDatos...
            return view($indexAdminView, $this->cargarDatosIndex());




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
            return view($configAdminView, [
                'usuarioAdmin' => $staffAdmin->usuario,
                'fotoAdmin' => $fotoAdmin
            ]);
        } else {
            return redirect()->route('admin', ['accion' => 'index']);
        }
    }

}
