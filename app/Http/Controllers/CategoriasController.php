<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Helpers\GlobalVariables;

class CategoriasController extends Controller
{

    /* LOGICA DE CATEGORIA */

    public function handleAddCategory(Request $request){

        $nombre = $request->input('nombreCategoria');
        $imagen = file_get_contents($request->file('imgCategoria')->getRealPath());
        $desc = $request->input('descripcionCategoria');
    
    
        if (!empty($nombre) && !empty($imagen) && !empty('desc')) {
            $category = Categoria::create([
                'nom_categoria' => $nombre,
                'desc_categoria' => $desc,
                'imagen' => $imagen
            ]);
    
            echo "Insercion Exitosa";
            }else{
                echo "Fallo en la inserción";
            }
    
        }

    /* ACTUALIZACION DE CATEGORIA */

    public function handleUpdateCategory(Request $request, $id)
    {
        try {

            dd($request->all());

            $categoria = Categoria::where('id_categoria', $id)->firstOrFail();
    

            $categoria->nom_categoria = $request->input('nombreCategoria');
            $categoria->desc_categoria = $request->input('descripcionCategoria');
    

            if ($request->hasFile('imgCategoria') && $request->file('imgCategoria')->isValid()) {
                $categoria->imagen = file_get_contents($request->file('imgCategoria')->getRealPath());
            }
    

            $categoria->save();
    
            return redirect()->route('admin');
        } catch (\Throwable $th) {
            \Log::error('Error al actualizar la categoría: ' . $th->getMessage());
            return back()->withErrors(['error' => 'Ocurrió un error al actualizar la categoría.']);
        }
    }
    
    


    /* ELIMINACION DE CATEGORIA */
    
    public function handleDeleteCategory(Request $request){
        
        $id = $request->input('deleteButton');
        
        $category = Categoria::where('id_categoria', $id)->first();
        
        if ($category) {
            
            $category->destroy();
            
        }
        
        return redirect('#');

    }

    public function crudCategorias(Request $request, $accion = null){

        $viewCategorias = GlobalVariables::$viewCategorias;
        $viewCategorias2 = GlobalVariables::$viewCategorias2;

        if ($accion === 'nuevo') {
            $modeValidator = '2';
            return view($viewCategorias2, compact('modeValidator'));
        } elseif ($accion === 'ver') {
            $categorias = Categoria::all()->toArray();
            return view($viewCategorias, compact('categorias'));
        } elseif ($accion === 'editar' && $request->has('editCategoria')) {
            $id = $request->input('editCategoria');
            $categoria = Categoria::where('id_categoria', $id)->first();
            $modeValidator = '1';
            return view($viewCategorias2, compact('categoria', 'modeValidator'));
        } else {
            return redirect()->route('crudCategorias', ['accion' => 'ver']);
        }

    }


}
