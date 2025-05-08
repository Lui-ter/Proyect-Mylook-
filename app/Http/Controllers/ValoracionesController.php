<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionesController extends Controller
{
    public function showFormValoracion($idCita)
{
    return view('Formularios.Insercciones.registerValoraciones', ['id_cita' => $idCita]);
}
    public function handleAddValoracion(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'id_cita' => 'required|exists:cita,id_cita',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:255'
        ]);

        // Obtener los datos del request
        $idCita = $request->input('id_cita');
        $calificacion = $request->input('calificacion');
        $comentario = $request->input('comentario');

        // Crear la valoración
        Valoracion::create([
            'id_cita' => $idCita,
            'calificacion' => $calificacion,
            'comentario' => $comentario
        ]);

        return redirect()->route('usuarios', ['accion' => 'index']);
    }
    public function handleUpdateValoracion(Request $request, $id)
    {
        // Validar los datos del request
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:255'
        ]);

        // Obtener la valoración
        $valoracion = Valoracion::findOrFail($id);

        // Actualizar los datos de la valoración
        $valoracion->calificacion = $request->input('calificacion');
        $valoracion->comentario = $request->input('comentario');
        $valoracion->save();

        return redirect()->route('usuarios', ['accion' => 'index']);
    }
    public function handleDeleteValoracion($id)
    {
        // Obtener la valoración
        $valoracion = Valoracion::findOrFail($id);

        // Eliminar la valoración
        $valoracion->delete();

        return redirect()->route('usuarios', ['accion' => 'index']);
    }
}