<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Auth;

class ServiciosController extends Controller
{

/* INSERCIÓN DE SERVICIO */

    public function handleAddService(Request $request){

        // Aqui se validan los datos que provienen del formulario de servicios
        $request->validate([
            'idCategoria' => 'required|numeric|exists:categoria,id_categoria',
            'nombreServicio' => 'required|string',
            'descripcionServicio' => 'required|string',
            'precioServicio' => 'required|numeric',
            'duracionServicio' => 'required|numeric',
        ]);

        Servicio::create([
            'id_categoria' => $request->idCategoria,
            'nombre_servicio' => $request->nombreServicio,
            'desc_servicio' => $request->descripcionServicio,
            'duracion_serv' => $request->duracionServicio,
            'precio_servicio' => $request->precioServicio
        ]);

        return redirect()->route('servicios', ['accion' => 'ver', 'id' => $request->idCategoria]);

    }

/* ACTUALIZACION DE SERVICIO */

    public function handleUpdateService(Request $request, $id){

        $request->validate([
            'nombreServicio' => 'required|string',
            'descripcionServicio' => 'required|string',
            'precioServicio' => 'required|numeric',
            'duracionServicio' => 'required|numeric',
        ]);

        $servicio = Servicio::where('id_servicio', $id)->firstOrFail();
        $servicio->nombre_servicio = $request->input('nombreServicio');
        $servicio->desc_servicio = $request->input('descripcionServicio');
        $servicio->duracion_serv = $request->input('duracionServicio');
        $servicio->precio_servicio = $request->input('precioServicio');
        $servicio->save();

        return redirect()->route('servicios', ['accion' => 'ver', 'id' => $request->idCategoria]);

    }

/* VIEWS CRUD SERVICIOS */

    function crudServicios(Request $request, $accion = null){

        $viewCrudServicios = GlobalVariables::$viewCrudServicios;
        $viewServicios = GlobalVariables::$viewServicios;

        if ($accion === 'editar' && $request->has('editServicio')) {
            $id = $request->input('editServicio');
            $servicio = Servicio::where('id_servicio', $id)->first();
            $idCategoria = Servicio::where('id_servicio', $id)->value('id_categoria');
            $categorias = Categoria::where('id_categoria', $idCategoria)->first();
            $modeValidator = '1';
            return view($viewCrudServicios, compact('servicio', 'modeValidator', 'categorias'));

        } elseif ($accion === 'eliminar' && $request->has('deleteServicio')) {
            $id = $request->input('deleteServicio');
            Servicio::where('id_servicio', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');

        } elseif ($accion === 'nuevo') {
            $idCategoria = $request->input('id');
            $categorias = Categoria::where('id_categoria', $idCategoria)->first();
            $modeValidator = '2';
            return view($viewCrudServicios, compact( 'modeValidator', 'categorias'));

        } elseif ($accion === 'ver') {
            // Aqui se obtiene los datos del negocio logueado para tomar el nombre
            $negocio = Auth::guard('negocio')->user();
            $nombreNegocio = $negocio->nombre_negocio;
            // Aqui se obtiene el id de la categoria para realizar la consulta y asi muestre los servicios relacionados a esa categoria nada mas
            $idCategoria = $request->input('id');
            $categorias = Categoria::where('id_categoria', $idCategoria)->first();
            $categorias['imagen'] = 'data:image/png;base64,' . base64_encode($categorias['imagen']);
            $servicios = Servicio::where('id_categoria', $idCategoria)->get();

            return view($viewServicios, compact('servicios', 'nombreNegocio', 'categorias'));

        }
    }

}
