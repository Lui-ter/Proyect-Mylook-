<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Helpers\GlobalVariables;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Auth;
use App\Models\notificacion;
use App\Models\Staff;
use App\Models\ReservaProducto;
use App\Models\Usuario;



class ProductosController extends Controller
{


    private function notificacionUsuario(){
        if (Auth::guard('usuario')->check()) {
        // Notificaciones de usuario
        $notificaciones = Notificacion::with('cita')->where('estado', 'Aceptado')->get()->map(function ($notificacion) {
            return array_merge(
                $notificacion->toArray(),
                [
                    'fecha' => $notificacion->cita ? $notificacion->cita->fecha_cita : null,
                    'estado' => $notificacion->cita ? $notificacion->cita->estado : null,
                ]
            );
        })->toArray();
        }elseif (Auth::guard('negocio')->check()) {
        // Notificaciones de negocio
        $notificaciones = Notificacion::with('cita')->where('estado', 'Pendiente')->get()->map(function ($notificacion) {
            return array_merge(
                $notificacion->toArray(),
                [
                    'fecha' => $notificacion->cita ? $notificacion->cita->fecha_cita : null,
                    'estado' => $notificacion->cita ? $notificacion->cita->estado : null,
                ]
            );
        })->toArray();
        } else {
            $notificaciones = [];
        }
        $idNegocio = Auth::guard('negocio')->user()->id_negocio;
        $Staff_admin = Staff::where('id_negocio', $idNegocio)
        ->where('id_rol', 1)
        ->with(['usuario', 'rol'])
        ->get();

    foreach ($Staff_admin as $Staff) {
        if ($Staff->usuario && $Staff->usuario->img_usuario) {
            $imgStaff = 'data:image/png;base64,' . base64_encode($Staff->usuario->img_usuario);
        } else {
            $imgStaff = 'https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true';
        }
    }
        return compact('notificaciones','imgStaff');
    }
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

            $existeProducto = Producto::where([
                ['nombre_prod', '=', $nombre],
                ['id_establc','=', $idEstablecimiento],
                ['nom_marca', '=', $marca],
                ['desc_prod', '=', $desc],
                ['stock','=', $cantidad],
                ['valor_prod','=', $valor]
            ])->first();
            if($existeProducto){
                return redirect()->route('admin',['accion' =>'index']);
            }

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
                $product->delete();

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
            return view($viewCrudProductos, compact('producto','modeValidator')+ $this->notificacionUsuario());

        } elseif ($accion === 'eliminar' && $request->has('deleteProducto')) {
            // Se recibe el id del producto
            $id = $request->input('deleteProducto');
            $producto = Producto::find($id);
            // Buscar si hay alguna cita asociada con este producto
            $reservas = ReservaProducto::where('id_prod', $id)->with('cita')->get();
            foreach ($reservas as $reserva) {
                if (in_array(strtolower($reserva->cita->estado_cita), ['pendiente', 'aceptado'])) {
                    return redirect()->back()->with('error', 'No se puede eliminar el producto porque está en una cita activa');
                }
            }
            // Si todas las citas en su estado estan como Finalizadas, eliminar la relación y el producto
            ReservaProducto::where('id_prod', $id)->delete();
            $producto->delete();
            return redirect()->back()->with('success', 'Producto eliminado correctamente');
        } elseif ($accion === 'nuevo') {
            $modeValidator = 2;

             //Se obtiene el id_negocio de la sessión
             $idNegocio = Auth::guard('negocio')->user()->id_negocio;
             //para luego con el modelo obtenemos id_establecimiento para productos
             $idEstablecimiento = Establecimiento::where('id_negocio',$idNegocio)->value('id_establc');
             return view($viewCrudProductos, compact('idEstablecimiento')+ $this->notificacionUsuario());

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
