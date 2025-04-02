<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Helpers\GlobalVariables;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{

    /* LOGICA DE PRODUCTOS */

        public function handleAddProduct(Request $request){
            
            $nombre = $request->input('nombre');
            $idEstablecimiento = $request->input('idEstablecimiento');
            $marca = $request->input('marca');
            
            // Varible que recibe la imagen
            $file = $request->file('imagen');

            $imagen = file_get_contents($file->getRealPath()); // Convierte en binario la imagen
            $desc = $request->input('descripcion'); 
            $cantidad = $request->input('cantidad');
            $valor = $request->input('valor');

            // Se valida si las variables se estan recibiendo para la insercción
            if (!empty($nombre) && !empty($idEstablecimiento) && !empty($marca) && !empty($imagen) && !empty($desc) && !empty($cantidad) && !empty($valor)) {
                
                $product = Producto::create([
                    'id_establc' => $idEstablecimiento,
                    'nombre_prod' => $nombre,
                    'nom_marca' => $marca,
                    'desc_prod' => $desc,
                    'stock' => $cantidad,
                    'valor_prod' => $valor,
                    'img_prod' => $imagen
                ]);
        
                echo "Se insertó el producto correctamente";
                return redirect()->route('admin', ['accion' => 'index']);
        
            }else{
                echo "Faltan campos por diligenciar";
            }
        
        
        }
    
    /* ACTUALIZACION DE PRODUCTO */

        public function handleUpdateProduct(Request $request, $id){
                
                $producto = Producto::where('id_prod', $id)->firstOrFail();

                $producto->nombre_prod = $request->input('nombre');
                $producto->nom_marca = $request->input('marca');
                $producto->desc_prod = $request->input('descripcion');
                $producto->stock = $request->input('cantidad');
                $producto->valor_prod = $request->input('valor');

                if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
                    $producto->img_prod = file_get_contents($request->file('imagen')->getRealPath());
                }

                $producto->save();

                return redirect()->route('admin', ['accion' => 'index']);


        }

    /* ELIMINACION DE PRODUCTO */
    
        public function handleDeleteProduct(Request $request){
            
            $id = $request->input('deleteButton');
            
            $product = Producto::where('id_producto', $id)->first();

            if ($product) {
                
                $product->destroy();
                
            }
            
            return redirect('#');
            
        }

    /* VISTAS CRUD PRODUCTOS */

    public function crudProductos(Request $request, $accion = null){

        $viewCrudProductos = GlobalVariables::$viewCrudProductos;
        $viewProductos = GlobalVariables::$viewProductos;

        if ($accion === 'editar' && $request->has('editProducto')) {
            // Se recibe el id del producto
            $id = $request->input('editProducto');
            //Encuentra el producto con su id
            $producto = Producto::where('id_prod', $id)->first();
            // transforma la blob de la imagen para mostrarla en la vista
            $producto['img_prod'] = 'data:image/png;base64,' . base64_encode($producto['img_prod']);
            $modeValidator = 1;
            return view($viewCrudProductos, compact('producto','modeValidator'));

        } elseif ($accion === 'eliminar' && $request->has('deleteProducto')) {
            // Se recibe el id del producto
            $id = $request->input('deleteProducto');
            
            Producto::where('id_prod', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');

        } elseif ($accion === 'nuevo') {
            $modeValidator = 2;
            
             //Se obtiene el id_negocio de la sessión
             $idNegocio = Auth::guard('negocio')->user()->id_negocio;
             //para luego con el modelo obtenemos id_establecimiento para productos
             $idEstablecimiento = Establecimiento::where('id_negocio',$idNegocio)->value('id_establc');
             return view($viewCrudProductos, compact('idEstablecimiento'));

        } elseif ($accion === 'ver') {
            $idNegocio = Auth::guard('negocio')->user()->id_negocio;
            $idEstablecimiento = Establecimiento::where('id_negocio',$idNegocio)->value('id_establc');
            $productos = Producto::where('id_establc', $idEstablecimiento)->get()->toArray();

            
            foreach ($productos as &$producto) {
                if (isset($producto['img_prod'])) {
                    $producto['img_prod'] = 'data:image/png;base64,' . base64_encode($producto['img_prod']);
                }
            }
    
            return view($viewProductos, compact('productos'));

        } else {
            
            return redirect()->route('productos', ['accion' => 'ver']);
        }
    }
    


}
