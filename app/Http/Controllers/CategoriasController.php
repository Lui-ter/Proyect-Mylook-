<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Establecimiento;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{

/* LOGICA DE CATEGORIA */

    public function handleAddCategory(Request $request){

        // Aqui se validan los datos que provienen del formulario de categoria
        $request->validate([
            'idEstablecimiento' => 'required|numeric|exists:establecimiento,id_establc',
            'nombreCategoria' => 'required|string',
            'descripcionCategoria' => 'required|string',
            'imgCategoria' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        if($request->hasFile('imgCategoria')){
            $img = $request->file('imgCategoria');
            $imgCategoria = file_get_contents($img->getRealPath());
        };

        Categoria::create([
            'id_establc' => $request->idEstablecimiento,
            'nom_categoria' => $request->nombreCategoria,
            'desc_categoria' => $request->descripcionCategoria,
            'imagen' => $imgCategoria
        ]);

        return redirect()->route('admin', ['accion' => 'index']);
    }

/* ACTUALIZACION DE CATEGORIA */

    public function handleUpdateCategory(Request $request, $id){

        $request->validate([
            'nombreCategoria' => 'required|string',
            'descripcionCategoria' => 'required|string',
            'imgCategoria' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        $categoria = Categoria::where('id_categoria', $id)->firstOrFail();
        $categoria->nom_categoria = $request->input('nombreCategoria');
        $categoria->desc_categoria = $request->input('descripcionCategoria');
        // Si se selecciono una nueva imagen se guardara en la db, de lo contrario mantendra la imagen que tenia anteriormente
        if($request->hasFile('imgCategoria')){
            $img = $request->file('imgCategoria');
            $imgCategoria = file_get_contents($img->getRealPath());
            $categoria->imagen = $imgCategoria;
        }
        $categoria->save();

        return redirect()->route('admin', ['accion' => 'index']);
    }

    public function crudCategorias(Request $request, $accion = null){

        $viewCategorias = GlobalVariables::$viewCategorias;
        $viewCategorias2 = GlobalVariables::$viewCategorias2;

        if ($accion === 'nuevo') {
            // Se obtiene el id del negocio logueado para sacar el id del establecimiento asociado a ese negocio
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $idEstablecimiento = Establecimiento::where('id_negocio',$idNegocio)->value('id_establc');
            $modeValidator = '2';
            return view($viewCategorias2, compact('modeValidator', 'idEstablecimiento'));

        } elseif ($accion === 'ver') {
            $categorias = Categoria::all()->toArray();
            return view($viewCategorias, compact('categorias')); // Muestra una vista de categorias totalmente diferente

        } elseif ($accion === 'editar' && $request->has('editCategoria')) {
            $id_categoria = $request->input('editCategoria');
            $categoria = Categoria::where('id_categoria', $id_categoria)->first();
            $categoria['imagen'] = 'data:image/png;base64,' . base64_encode($categoria['imagen']);
            $modeValidator = '1';
            return view($viewCategorias2, compact('categoria', 'modeValidator'));

        }  elseif ($accion === 'eliminar' && $request->has('deleteCategoria')) {
            $id_categoria = $request->input('deleteCategoria');
            Categoria::where('id_categoria', $id_categoria)->delete();
            return redirect()->back()->with('success', 'Se elimino la categoria satisfactoriamente');
        }
    }
}
