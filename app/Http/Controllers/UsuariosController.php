<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Hash;
Use App\Models\Establecimiento;
use App\Models\Usuario;
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
            return view($agendamientoView);
        }elseif($accion === 'config'){
            $id = session('id_usuario');
            $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
            return view($configUsersView, compact(('usuario')));
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
            'nombre' => $request->nombreAdmin . ' ' . $request->apellidoAdmin, // En la tabla solo hay un campo para el nombre, entonces aqui se une junto con el apellido que provienen de los inputs del formulario
            'correo' => $request->correoAdmin,
            'telefono' => $request->telefonoAdmin,
            'contrasena' => Hash::make($request->contrasenaAdmin),
        ]);

        // Aqui se guarda los siguientes datos del formulario perfil administrador para poder usarlo en en el formulario de negocio, como es la misma vista entonces se guarda en una sesión
        session([
            'id_usuario' => $usuario->id_usuario,
            'nombreAdmin' => $usuario->nombre,
            'apellidoAdmin' => $usuario->apellido
        ]);
        
        return redirect()->route('negocio', ['accion' => 'config']);
    }

    
    public function handleUpdateUsers(Request $request, $id){


        $usuario = Usuario::where('id_usuario', $id)->firstOrFail();

        $usuario->nombre_usuario = $request->input('nombreUsuario') . ' ' . $request->input('apellidoUsuario');
        $usuario->correo = $request->input('correoUsuario');
        $usuario->documento = $request->input('documentoUsuario');
        $usuario->telegono = $request->input('telefonoUsuario');
        $usuario->condicion = $request->input('condicionUsuario');

        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $usuario->img_prod = file_get_contents($request->file('imagen')->getRealPath());
        }

        $usuario->save();

        return redirect()->route('usuario', ['accion' => 'index']);


}

}