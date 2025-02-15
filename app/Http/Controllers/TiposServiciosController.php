<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoServicio;
use App\Models\Categoria;
use App\Helpers\GlobalVariables;

class TiposServiciosController extends Controller
{

    /* LOGICA DE SERVICIOS */

        public function handleAddServiceType(Request $request){

            $id_categoria = $request->input('Categoria');
        
            $tipoServ = $request->input('nombreServicios');
        
            if (!empty($id_categoria) && !empty('tipoServ')) {
        
                    $tipo = TipoServicio::create([
                        'id_categoria' => $id_categoria,
                        'tipo_serv' => $tipoServ
                    ]);
        
                    echo "Inserción realizada correctamente";
                }
        
        }

    /* ACTUALIZACION DE TIPO SERVICIO */

        public function handleUpdateServiceType(Request $request, $id){

            try {

                $tipoServicio = TipoServicio::where('id_tiposerv', $id)->firstOrFail();

                $tipoServicio->tipo_serv = $request->input('nombreServicios');

                $tipoServicio->id_categoria = $request->input('Categoria');

                                
                if (!$tipoServicio->save()) {
                    dd('Error al guardar el servicio');
                }

                return redirect()->route('tipoServicios');

            } catch (\Throwable $th) {
                \Log::error('Error al actualizar el tipo de servicio: ' . $th->getMessage());
                return back()->withErrors(['error' => 'Ocurrió un error al actualizar el tipo de servicio.']);
            }


        }

    /* ELIMINACION DE TIPO DE SERVICIO */
    
        public function handleDeleteTypeService(Request $request){
            
            $id = $request->input('deleteButton');
            
            $tipoServicio = TipoServicio::where('id_tiposerv', $id)->first();
            
            if ($tipoServicio) {
                
                $tipoServicio->destroy();
                
            }

            
            
            return redirect('#');
            
            
        }    

    /* VIEWS CRUD TIPOS DE SERVICIO */

        function crudTipoServicios(Request $request, $accion = null){

            $viewCrudTipoServicio = GlobalVariables::$viewCrudTipoServicio;
            $viewTipoServicios = GlobalVariables::$viewTipoServicios;
        
            if ($accion === 'editar' && $request->has('editTipoServicio')) {
                $id = $request->input('editTipoServicio');
                $typeServices = TipoServicio::where('id_tiposerv', $id)->first();
                $categoryData = Categoria::all()->toArray();
                $modeValidator = '1';
                return view($viewCrudTipoServicio, compact('typeServices', 'modeValidator', 'categoryData'));
        
            } elseif ($accion === 'eliminar' && $request->has('deleteTipoServicio')) {
                $id = $request->input('deleteTipoServicio');
                TipoServicio::where('id_tiposerv', $id)->delete();
                return redirect()->back()->with('success', 'Operación completada exitosamente.');
        
            } elseif ($accion === 'nuevo') {
                $modeValidator = '2';
                $categoryData = Categoria::all()->toArray();
                return view($viewCrudTipoServicio, compact('modeValidator', 'categoryData'));
        
            } elseif ($accion === 'ver') {
                $tipoServicios = TipoServicio::all()->toArray();
                return view($viewTipoServicios, compact('tipoServicios'));
        
            } else {
                return redirect()->route('tipoServicios', ['accion' => 'ver']);
            }
        }
    

}
