<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Helpers\GlobalVariables;

class StaffController extends Controller
{


    /* INSERCIÓN DE STAFF */

    public function handleAddStaff(Request $request){

    // Obtener los datos del request
    $documentoStaff = $request->input('documentoStaff');
    $nombreCompletoStaff = $request->input('nombreCompletoStaff');
    $telefonoStaff = $request->input('telefonoStaff');
    $direccionStaff = $request->input('direccionStaff');
    $contrasenaStaff = password_hash($request->input('contrasenaStaff'), PASSWORD_BCRYPT);

    // Crear un nuevo registro en la tabla `staff`
    $staff = Staff::create([
    'documento_staff' => $documentoStaff,
    'nombre_completo' => $nombreCompletoStaff,
    'telefono' => $telefonoStaff,
    'direccion' => $direccionStaff,
    'contrasena' => $contrasenaStaff,
    ]);

    return redirect()->route('admin');

    /* PENDIENTE PARA REVISAR ESTA LOGICA - A LA ESPERA DE CAMBIOS EN BD */

    }


    /* ACTUALIZACIÓN DE STAFF */

    public function handleUpdateStaff(Request $request){

        if ($request->has('updateButton')) {

            $id = $request->input('updateButton');

            $staff = Staff::where('id_usuario', $id)->firstOrFail();

            $staff->telefono = $request->input('telefono');
            $staff->img_staff = file_get_contents($request->file('img_staff')->getRealPath());

            $staff->save();

        }

        return redirect('#');

    }

    /* ELIMINACION DE STAFF */
    
    public function handleDeleteStaff(Request $request){
        
        $id = $request->input('deleteButton');
        
        $staff = Staff::where('id_producto', $id)->first();
        
        if ($staff) {
            
            $staff->id_rol = 1;
            $staff->save();

        } 
        
        return redirect('#');
        
    }

    public function crudStaff(Request $request, $accion = null){

        $indexStaff = GlobalVariables::$indexStaff;
        $registerStaff = GlobalVariables::$registerStaff;
        $loginStaff = GlobalVariables::$loginStaff;

        if($accion === 'index'){
            return view($indexStaff);
        }elseif($accion === 'register'){
            return view($registerStaff);
        }elseif($accion === 'login'){
            return view($loginStaff);
        }else{
            return redirect()->route('staff', ['accion' => 'index']);
        }

    }

}
