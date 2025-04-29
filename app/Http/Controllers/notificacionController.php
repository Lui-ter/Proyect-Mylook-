<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\notificacion;

class notificacionController extends Controller
{
    // Funcion que se activa luego del evento del js en bandeja.blade.php
    public function borrarNotificacion(Request $request, $id){
        $notificacion = notificacion::find($id);
        if ($notificacion) {
            $notificacion->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Notificación no encontrada'], 404);

    }
}
