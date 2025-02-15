<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Staff;
use App\Helpers\GlobalVariables;

class AdminController extends Controller
{

    public function crudAdmin(Request $request, $accion = null){

        $registerView = GlobalVariables::$registerAdminView;

        $loginAdminView = GlobalVariables::$loginAdminView;

        $indexAdminView = GlobalVariables::$indexAdminView;

        $configAdminView = GlobalVariables::$configAdminView;
        
        
        if($accion === 'index'){
            $categorias = Categoria::all()->toArray();
            
            $productsPreview = Producto::latest()->take(3)->get()->toArray();
            
            $infoStaff = Staff::with('usuario', 'rol')->get()->toArray();


            
            foreach ($categorias as &$categoria) {
                if (isset($categoria['imagen'])) {
                    $categoria['imagen'] = 'data:image/png;base64,' . base64_encode($categoria['imagen']);
                }
            }

            foreach ($productsPreview as &$productPreview){
                if (isset($productPreview['img_prod'])) {
                    $productPreview['img_prod'] = 'data:image/png;base64,' . base64_encode($productPreview['img_prod']);
                }
            }

            foreach ($infoStaff as &$staff){
                if (isset($staff['img_staff'])) {
                    $staff['img_staff'] = 'data:image/png;base64,' . base64_encode($staff['img_staff']);
                }
            }

            return view($indexAdminView, compact('categorias','productsPreview', 'infoStaff'));
        }elseif($accion === 'register'){
            return view($registerView);
        }elseif($accion === 'login'){
            return view($loginAdminView);
        }elseif($accion === 'config'){
            return view($configAdminView);
            
        }else{
            return redirect()->route('admin', ['accion' => 'index']);
        }

    }


}
