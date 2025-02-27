<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Negocio;
use App\Models\Usuario;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Hash;

class NegociosController extends Controller{

/*  INSERCION DE UN NEGOCIO   */

    public function handleAddNegocio(Request $request){

        // Aqui se validan los datos que provienen del formulario de negocio
        $request->validate([
            'idNegocio' => 'required|string|max:15|unique:negocio,id_negocio',
            'id_usuario' => 'required|numeric',
            'nombreNegocio' => 'required|string|max:30',
            'contrasenaNegocio' => 'required|string'
        ]);

        // Aqui se crea un nuevo un nuevo registro de negocio en la tabla 
        $negocio = Negocio::create([
            'id_negocio' => $request->idNegocio,
            'id_usuario' => $request->id_usuario,
            'nombre_negocio' => $request->nombreNegocio,
            'contrasena' => Hash::make($request->contrasenaNegocio),
        ]);

        // Aqui guarda la id_negocio en la sesión para usarlo en el formulario de establecimiento ya que esta en la misma vista
            session(['id_negocio' => $negocio->id_negocio]);

        // Aqui se elimina de la sesion los datos que estaban cargados en el formulario de perfil administrador     
            session()->forget(['id_usuario','nombreAdmin', 'apellidoAdmin']);

        return redirect()->route('negocio', ['accion' => 'config']);
    }

    /* ACTUALIZACIÓN DE NEGOCIO */

    public function handleUpdateBussiness(Request $request, $id){
        if ($request->has('updateButton')) {
            $id = $request->input('updateButton');

            $negocio = Negocio::where('id_negocio', $id)->firstOrFail();
            $negocio->id_negocio = $request->input('idNegocio');
            $negocio->nombre_negocio = $request->input('nombreNegocio');
            $negocio->desc_negocio = $request->input('descripcionNegocio');
            if ($negocio->id_usuario) {
                $usuario = Usuario::where('id_usuario', $negocio->id_usuario)->first();
                if ($usuario) {
                    $usuario->nombre = $request->input('nombreAdmin');
                    $usuario->save();
                }
            }
            return redirect()->back()->with('completado', 'Negocio y administrador actualizados correctamente.');
        }

        return redirect()->back()->with('error', 'Error al actualizar el negocio.');
    }

    /* ELIMINACION DE NEGOCIO */

    public function handleDeleteBussiness(Request $request){

        $id = $request->input('deleteButton');

        $negocio = Negocio::where('id_negocio', $id)->first();

        if ($negocio) {

            $negocio->destroy();

        }

        return redirect('#');

    }


    public function crudNegocios(Request $request, $accion = null){

        $configNegocio = GlobalVariables::$configBienvenidaMiNegocio;

        if($accion === 'config'){
            return view($configNegocio);
        }elseif($accion === 'logout'){ 
            Auth::guard('usuario')->logout(); 
            $request->session()->invalidate(); 
            $request->session()->regenerateToken(); 
            $indexView = GlobalVariables::$indexView; 
            return view($indexView);    
        }else{
            return redirect()->route('admin');
        }

    }

}