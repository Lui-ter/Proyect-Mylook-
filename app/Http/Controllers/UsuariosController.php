<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\GlobalVariables;
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
            $mejoresEstablecimientos = Establecimiento::orderByDesc('valoracion_final')
            ->take(7)
            ->get(['id_establc','nombre_establc', 'img_establc','desc_establc'])
            ->toArray();
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
