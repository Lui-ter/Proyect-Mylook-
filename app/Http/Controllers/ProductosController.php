<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Helpers\GlobalVariables;

class ProductosController extends Controller
{

    /* LOGICA DE PRODUCTOS */

        public function handleAddProduct(Request $request){
        
            $nombre = $request->input('nombre');
            $marca = $request->input('marca');
            $imagen = file_get_contents($request->file('imagen')->getRealPath());
            $desc = $request->input('desc');
            $cantidad = $request->input('cantidad');
            $valor = $request->input('valor');
        
            if (!empty($nombre) && !empty($marca) && !empty($imagen) && !empty($desc) && !empty($cantidad) && !empty($valor)) {
                
                $product = Producto::create([
                    'nombre_prod' => $nombre,
                    'nom_marca' => $marca,
                    'desc_prod' => $desc,
                    'stock' => $cantidad,
                    'valor_prod' => $valor,
                    'img_prod' => $imagen
                ]);
        
                echo "Se insertó el producto correctamente";
                return redirect('indexadmin');
        
            }else{
                echo "Faltan campos por diligenciar";
            }
        
        
        }
    
    /* ACTUALIZACION DE PRODUCTO */

        public function handleUpdateProduct(Request $request, $id){
                
                $producto = Producto::where('id_prod', $id)->firstOrFail();

                $producto->nombre_prod = $request->input('nombre');
                $producto->nom_marca = $request->input('marca');
                $producto->desc_prod = $request->input('desc');
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

            $id = $request->input('editProducto');
            $producto = Producto::where('id_prod', $id)->first();
            $producto['img_prod'] = 'data:image/png;base64,' . base64_encode($producto['img_prod']);
            $modeValidator = 1;
            return view($viewCrudProductos, compact('producto','modeValidator'));

        } elseif ($accion === 'eliminar' && $request->has('deleteProducto')) {

            $id = $request->input('deleteProducto');
            Producto::where('id_prod', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');

        } elseif ($accion === 'nuevo') {
            $modeValidator = 2;
            return view($viewCrudProductos, compact('modeValidator'));

        } elseif ($accion === 'ver') {

            $productos = Producto::all()->toArray();
            
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
