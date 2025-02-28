<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Hash;
Use App\Models\Establecimiento;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Valoracion;
use App\Models\Negocio;
use Illuminate\Contracts\Session\Session;

class UsuariosController extends Controller
{

    /*INDEX USUARIO DE MYLOOK */

     function showIndexUsuario(){
        return view('Index.indexUsuario');
    }

    public function crudUsuarios(Request $request, $accion = null){

        $indexUsuarioView = GlobalVariables::$indexUsuarioView;
        $agendamientoView = GlobalVariables::$agendamientoView;
        $configUsersView = GlobalVariables::$configUsersView;

        if ($accion === 'index') {
            $mejoresEstablecimientos = Establecimiento::orderByDesc('valoracion_final')->take(7)->get(['nombre_establc', 'img_establc','desc_establc', 'id_establc'])->toArray();
            return view($indexUsuarioView, compact('mejoresEstablecimientos'));
        }elseif($accion === 'agendar'){
            $id = $request->input('id_establecimiento');
            $establecimiento = Establecimiento::where('id_establc', $id)->first()->toArray();
            $productos = Producto::where('id_establc', $id)->get()->toArray();
            $categorias = Categoria::where('id_establc', $id)->get()->toArray();
            $valoraciones = Valoracion::with(['cita' => function ($query) use ($id) {
                $query->where('id_establc', $id)
                      ->with('usuario');
            }])->get()->toArray();

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
        }elseif($accion === 'config'){
            $id = session('usuario_id');
            $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
            return view($configUsersView, compact(('usuario')));
            dd($id);
        }elseif($accion === 'logout'){
                Auth::guard('usuario')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $indexView = GlobalVariables::$indexView;
                return view($indexView);
        }else{
            return redirect()->route('usuarios', ['accion' => 'index']);
        }

    }

/*  INSERCION DE UN USUARIO ADMIN (Falta especificar el rol, en las migraciones no esta unida la tabla rol con usuario)   */

    public function handleAddUser(Request $request){

        // Aqui se validan los datos que provienen del formulario de perfil administrador
        $request->validate([
            'idAdmin' => 'required|numeric|unique:usuario,id_usuario',
            'nombreAdmin' => 'required|string|max:30',
            'apellidoAdmin' => 'required|string|max:30',
            'correoAdmin' => 'nullable|email|unique:usuario,correo',
            'telefonoAdmin' => 'nullable|string|max:30',
            'contrasenaAdmin' => 'required|string'
        ]);

        // Aqui se crea un nuevo usuario en la tabla falta especificar que es con el rol de administrador
        $usuario = Usuario::create([
            'id_usuario' => $request->idAdmin,
            'nombre' => $request->nombreAdmin,
            'apellido' => $request->apellidoAdmin, 
            'correo' => $request->correoAdmin,
            'telefono' => $request->telefonoAdmin,
            'contrasena' => Hash::make($request->contrasenaAdmin),
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
        return view('Configuracion/configBienvenidaMiNegocio',compact('negocioData'));

    }


    public function handleUpdateUsers(Request $request, $id){


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