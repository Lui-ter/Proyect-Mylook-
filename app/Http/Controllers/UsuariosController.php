<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Hash;
use App\Models\Establecimiento;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Valoracion;
use App\Models\Negocio;
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

                $establecimientosRecomendados = Establecimiento::with('negocio')
                ->inRandomOrder()
                ->take(6)
                ->get(); // ← no usamos toArray() para evitar errores
        
            return view($indexUsuarioView, compact('mejoresEstablecimientos', 'establecimientosAleatorios', 'establecimientosRecomendados'));

        } elseif ($accion === 'agendar') {
            $id = $request->input('id_establecimiento');
            $establecimiento = Establecimiento::where('id_establc', $id)->first()->toArray();
            $productos = Producto::where('id_establc', $id)->get()->toArray();
            $categorias = Categoria::where('id_establc', $id)->get()->toArray();
            $valoraciones = Valoracion::with([
                'cita' => function ($query) use ($id) {
                    $query->where('id_establc', $id)
                        ->with('usuario');
                }
            ])->get()->toArray();

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

            return view($agendamientoView, compact('establecimiento', 'productos', 'categorias', 'valoraciones'));
        } elseif ($accion === 'config') {
            $id = session('usuario_id');
            $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
            return view($configUsersView, compact(('usuario')));
            dd($id);
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
