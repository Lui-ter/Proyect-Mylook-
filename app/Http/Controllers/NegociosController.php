<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Negocio;
use Illuminate\Contracts\Session\Session;
use App\Helpers\GlobalVariables;


class NegociosController extends Controller{

    /* ACTUALIZACIÓN DE NEGOCIO */

    public function handleUpdateNegocio(Request $request, $id){

        // Aqui se validan los datos que provienen del formulario de negocio
        $request->validate([
            'id_usuario' => 'required|numeric',
            'descripcionNegocio' => 'required|string',
            'img_portada' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'img_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla en la tabla si no dejara el campo como null
        $img_portada = null;
        $img_logo = null;
        if($request->hasFile('img_portada')){
            $imgPortada = $request->file('img_portada');
            $img_portada = file_get_contents($imgPortada->getRealPath());
        };
        if($request->hasFile('img_logo')){
            $imgLogo = $request->file('img_logo');
            $img_logo = file_get_contents($imgLogo->getRealPath());
        }

        // Aqui se actualiza el registro de negocio encontrado a travez de su id
        $negocioData = Negocio::findOrFail($id);
        $negocioData->id_usuario = $request->input('id_usuario');
        $negocioData->desc_negocio = $request->input('descripcionNegocio');
        $negocioData->img_portada = $img_portada;
        $negocioData->img_perfil = $img_logo;
        $negocioData->save();

        // Aqui guarda la id_negocio en la sesión para usarlo en el formulario de establecimiento ya que esta en la misma vista
        session(['id_negocio' => $negocioData->id_negocio]);

        // Aqui se elimina de la sesion los datos que estaban cargados en el formulario de perfil administrador
        session()->forget(['id_usuario','nombreAdmin', 'apellidoAdmin']);

        return view('Configuracion.configBienvenidaMiNegocio',compact('negocioData'));
    }



    /* ELIMINACION DE NEGOCIO */

    public function handleDeleteBussiness(Request $request){

        $id = $request->input('deleteButton');

        $negocio = Negocio::where('id_negocio', $id)->first();

        if ($negocio) {

            $negocio->delete();

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

            $indexView = GlobalVariables::$indexView;
            return view($indexView);
        }else{
            return redirect()->route('admin');
        }

    }

}
