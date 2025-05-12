<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Negocio;
use App\Models\Staff;
use Illuminate\Contracts\Session\Session;
use App\Helpers\GlobalVariables;


class NegociosController extends Controller{

    /* ACTUALIZACIÓN DE NEGOCIO CUANDO SE CREA POR PRIMERA VEZ*/

    public function handleUpdateNegocio(Request $request){

        $registerEstablecimiento = GlobalVariables::$registerEstablecimiento;

        // Aqui se validan los datos que provienen del formulario de negocio
        $request->validate([
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
        $negocio = Negocio::find(Auth::guard('negocio')->user()->id_negocio);
        $negocio->update([
            'desc_negocio' => $request->descripcionNegocio,
            'img_portada' => $img_portada,
            'img_perfil' => $img_logo
        ]);
        return view($registerEstablecimiento);
    }

// ACTUALIZACION DE NEGOCIO DESDE EL PANEL DE ADMINISTRADOR

    public function handleUpdateNegocioTwo(Request $request, $id){

        $negocioData = Negocio::findOrFail($id);
        // Aqui se validan los datos que provienen del formulario de negocio
        $request->validate([
            'id_usuario' => 'required|numeric',
            'nombreNegocio' => 'nullable|string',
            'descripcionNegocio' => 'required|string',
            'img_portada' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'img_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        // Aqui se verifica si el usuario cargo una imagen y si lo hizo la convierte en binario para almacenarla en la tabla si no dejara el campo como null
        $img_portada = $negocioData->img_portada;
        $img_logo = $negocioData->img_perfil;
        if($request->hasFile('img_portada')){
            $imgPortada = $request->file('img_portada');
            $img_portada = file_get_contents($imgPortada->getRealPath());
        };
        if($request->hasFile('img_logo')){
            $imgLogo = $request->file('img_logo');
            $img_logo = file_get_contents($imgLogo->getRealPath());
        }

    // Aqui se actualiza el registro de negocio encontrado a travez de su id
        $negocioData->update([
            'nombre_negocio' => $request->nombreNegocio,
            'desc_negocio' => $request->descripcionNegocio,
            'img_portada' => $img_portada,
            'img_perfil' => $img_logo
        ]);
        return redirect()->route('admin', ['accion' => 'index']);
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

        $configNegocio = GlobalVariables::$configNegocioView;

        if($accion === 'config'){
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $negocio = Negocio::where('id_negocio', $idNegocio)->first();
            $img_perfil = 'data:image/png;base64,'. base64_encode($negocio->img_perfil);
            $img_portada = 'data:image/png;base64,' . base64_encode($negocio->img_portada);
            $staffAdmin = Staff::where('id_negocio', $idNegocio)
                ->where('id_rol', 1)
                ->first();
            return view($configNegocio, [
                'negocio' => $negocio,
                'img_perfil' => $img_perfil,
                'img_portada' => $img_portada,
                'staffAdmin' => $staffAdmin->usuario
            ]);

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
