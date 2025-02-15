<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Helpers\GlobalVariables;


class ServiciosController extends Controller
{

    /* INSERCIÓN DE SERVICIO */

        public function handleAddService(Request $request){
        

            $tipoServicio = $request->input('tipoServicio');
            $nombre = $request->input('nombreServicio');
            $precio = $request->input('precioServicio');
            $desc = $request->input('descripcionServicio');
            $duracion = $request->input('duracionServicio');
            $imagen = file_get_contents($request->file('imagenServicio')->getRealPath());
        
            if (!empty($tipoServicio) && !empty($nombre) && !empty($precio) && !empty($desc) && !empty($duracion) && !empty($imagen)) {
                
                $service = Servicio::create([
                        'id_tiposerv' => $tipoServicio,
                        'nom_servicio' => $nombre,
                        'desc_servicio' => $desc,
                        'duracion_serv' => $duracion,
                        'precio_servicio' => $precio,
                        'img_serv' => $imagen
                ]);
        
                echo "Todo se insertó correctamente";
            }else{
                echo "Faltan campos por diligenciar, no se pudo insertar el registro";
            }
        
        }

    /* ACTUALIZACION DE SERVICIO */

        public function handleUpdateService(Request $request, $id){

          
            try {

                $servicio = Servicio::where('id_servicio', $id)->firstOrFail();

                $servicio->nom_servicio = $request->input('nombreServicio');
                $servicio->desc_servicio = $request->input('descripcionServicio');
                $servicio->duracion_serv = $request->input('duracionServicio');
                $servicio->precio_servicio = $request->input('precioServicio');

                if ($request->hasFile('imagenServicio') && $request->file('imagenServicio')->isValid()) {
                    $servicio->img_serv = file_get_contents($request->file('imagenServicio')->getRealPath());
                }
                
                if (!$servicio->save()) {
                    dd('Error al guardar el servicio');
                }
                

                return redirect()->route('servicios', ['accion' => 'ver']);

            } catch (\Throwable $th) {
            \Log::error('Error al actualizar la categoría: ' . $th->getMessage());
            return back()->withErrors(['error' => 'Ocurrió un error al actualizar la categoría.']);
            }
                



        }

    /* VIEWS CRUD SERVICIOS */

        function crudServicios(Request $request, $accion = null){

            $viewCrudServicios = GlobalVariables::$viewCrudServicios;
            $viewServicios = GlobalVariables::$viewServicios;
        
            if ($accion === 'editar' && $request->has('editServicio')) {
                $id = $request->input('editServicio');
                $servicio = Servicio::where('id_servicio', $id)->first();
                $servicio['img_serv'] = 'data:image/png;base64,' . base64_encode($servicio['img_serv']);
                $typeServices = TipoServicio::all()->toArray();
                $modeValidator = '1';
                return view($viewCrudServicios, compact('servicio', 'typeServices', 'modeValidator'));
        
            } elseif ($accion === 'eliminar' && $request->has('deleteServicio')) {
                $id = $request->input('deleteServicio');
                Servicio::where('id_servicio', $id)->delete();
                return redirect()->back()->with('success', 'Operación completada exitosamente.');
        
            } elseif ($accion === 'nuevo') {
                $modeValidator = '2';
                $typeServices = TipoServicio::all()->toArray();
                return view($viewCrudServicios, compact('typeServices', 'modeValidator'));
        
            } elseif ($accion === 'ver') {

                $tipoServicio = TipoServicio::all()->toArray();

                $servicios = Servicio::all()->toArray();
                foreach ($servicios as &$servicio) {
                    if (isset($servicio['img_serv'])) {
                        $servicio['img_serv'] = 'data:image/png;base64,' . base64_encode($servicio['img_serv']);
                    }
                }
                return view($viewServicios, compact('servicios', 'tipoServicio'));
        
            } else {
                return redirect()->route('servicios', ['accion' => 'ver']);
            }
        }
    


}
