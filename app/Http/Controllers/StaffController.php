<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Usuario;
use App\Models\Establecimiento;
use App\Helpers\GlobalVariables;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;

class StaffController extends Controller
{

    public function getStaff() {
        $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
        return view('Formularios.Login.registerStaff', compact('roles'));
    }
    /* INSERCIÓN DE STAFF */

    public function handleAddStaff(Request $request)
    {
        //obtener foraneas
        $idNegocio = Auth::guard('negocio')->user()->id_negocio;
        $idEstablecimiento = Establecimiento::where('id_negocio', $idNegocio)->value('id_establc');
       
        // Obtener los datos del request
        $documentoStaff = $request->input('documentoStaff');
        $nombreCompletoStaff = $request->input('nombreCompletoStaff');
        $correoStaff = $request->input('correoStaff');
        $contrasenaStaff = password_hash($request->input('contrasena'), PASSWORD_BCRYPT);
        $telefonoStaff = $request->input('telefonoStaff');
        $rolStaff = $request->input('tipoRol');
        $file = $request->file('imagenStaff');
        $imagen = file_get_contents($file->getRealPath());

        // Crear el Usuario asociado al Staff
        $usuario = Usuario::create([
            'id_usuario' => $documentoStaff,
            'nombre' => $nombreCompletoStaff,
            'contrasena' => $contrasenaStaff,
            'telefono' => $telefonoStaff,
            'correo' => $correoStaff,
            'img_usuario' => $imagen
        ]);
       
        // Crear la relacion Staff-Usuario
        Staff::create([
            'id_usuario' => $documentoStaff,
            'id_establc' => $idEstablecimiento,
            'id_negocio' => $idNegocio,
            'id_rol' => $rolStaff,
            
        ]);
        return redirect()->route('admin');

        //no envia la imagen
        /* PENDIENTE PARA REVISAR ESTA LOGICA - A LA ESPERA DE CAMBIOS EN BD */
        }

    /* ACTUALIZACIÓN DE STAFF */
    public function edit($id)
    {
        $staff = Staff::findOrFail($id); // Buscar el miembro del staff por ID
        $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
        return view('Formularios.Login.registerStaff', compact('staff', 'roles'));
    }
    
    public function handleUpdateStaff(Request $request, $id){

        if ($request->has('editStaff')) {
            $staff = Staff::findOrFail($id);
            $usuario = $staff->usuario;
            
            $usuario->nombre = $request->input('nombreCompletoStaff');
            $usuario->correo = $request->input('correoStaff');
            $usuario->telefono = $request->input('telefonoStaff');
            if ($request->filled('contrasena')) {
                $usuario->contrasena = password_hash($request->input('contrasena'), PASSWORD_BCRYPT);
            }
            if ($request->hasFile('imagenStaff') && $request->file('imagenStaff')->isValid()) {
                $usuario->img_usuario = file_get_contents($request->file('imagenStaff')->getRealPath());
            }
            $usuario->save();
            $staff->id_rol = $request->input('tipoRol');
            $staff->save();
            }
        return redirect()->route('admin');
    }        

    /* ELIMINACION DE STAFF */
    
    public function handleDeleteStaff(Request $request){
        
        $id = $request->input('deleteButton');
        
        $staff = Usuario::where('id_usuario', $id)->first();
        
        if ($staff) {
            
            $staff->id_rol = 1;
            $staff->save();

        } 
        return redirect()->route('admin');        
        
    }

    public function crudStaff(Request $request, $accion = null){

        $viewCrudStaff = GlobalVariables::$viewCrudStaff;
        $indexStaff = GlobalVariables::$indexStaff;
        $registerStaff = GlobalVariables::$registerStaff;
        $loginStaff = GlobalVariables::$loginStaff;

        if($accion === 'index'){
            return view($indexStaff);
        }elseif($accion === 'register'){
            $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
            return view($registerStaff, compact('roles'));
        }elseif($accion === 'login'){
            return view($loginStaff);
        }elseif ($accion === 'editar' && $request->has('editStaff')) {
            $id = $request->input('editStaff');
            // Obtener usuario y staff relacionado
            $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
            $staff = Staff::where('id_usuario', $id)->firstOrFail();
            // Codificar imagen
            $imgBase64 = 'data:image/png;base64,' . base64_encode($usuario->img_usuario);
            // Roles para el select
            $roles = Rol::where('nombre_rol', '!=', 'Administrador')->get();
            $modeValidator = 1;
            return view($viewCrudStaff, compact('staff', 'usuario', 'roles', 'modeValidator', 'imgBase64'));
        }elseif ($accion === 'eliminar' && $request->has('deleteStaff')) {
            // Se recibe el id del staff
            $id = $request->input('deleteStaff');
            
            Staff::where('id_usuario', $id)->delete();
            Usuario::where('id_usuario', $id)->delete();
            return redirect()->back()->with('success', 'Operación completada exitosamente.');
        }else{
            return redirect()->route('staff', ['accion' => 'index']);
        }
    }
}