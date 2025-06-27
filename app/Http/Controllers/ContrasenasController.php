<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperacionCodigoMail;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalVariables;
use App\Models\Usuario;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Log;

class ContrasenasController extends Controller
{

    /* Funcion para consultar, enviar el correo y crear la sesion */
    public function consultarCorreo(Request $request)
    {
        // Aqui valida si lo escrito en el form cumple con las condiciones
        $request->validate([
            'correo' => 'required|email:rfc,dns'
        ], [
            'correo.required' => 'El correo es obligatorio',
            'correo.email' => 'El correo electrónico no tiene un formato válido'
        ]);
        $correo = $request->correo;
        // Aqui se hace una consulta en Usuario y Negocio para ver si existe un registro con el correo suministrado en el formulario, si existe genera un codigo y lo envia al correo si no mostrara un mensaje de error
        $usuario = Usuario::where('correo', $request->correo)->exists();
        $establecimiento = Establecimiento::where('correo', $request->correo)->exists();
        if ($usuario || $establecimiento) {
            $codigo = strtoupper(Str::random(8));
            Mail::to($correo)->send(new RecuperacionCodigoMail($codigo, 5));
            // Se crea la sesion para saber que correo pide el cambio de contraseña, cual fue el codigo y que sea valido en el tiempo correspondiente
            session(['recuperacion' => [
                'correo' => $correo,
                'codigo' => $codigo,
                'expira_en' => now()->addMinutes(5)
            ]]);
            return redirect()->route('contrasenas', ['accion' => 'codeVerificacion']);
        } else {
            return back()->withErrors(['correo' => 'El correo no está registrado.'])->withInput();
        }
    }

    /* Funcion para verificar el codigo de verificacion que se envio al correo */
    public function codigoVerificacion(Request $request)
    {
        $request->validate(
            [
                'codigo' => 'required|string|size:8'
            ],
            [
                'codigo.required' => 'El código es obligatorio',
                'codigo.string'   => 'El código debe ser una cadena de texto',
                'codigo.size'     => 'El código debe tener exactamente 8 caracteres',
            ]
        );
        // Se obtienen los datos de la session para posteriores validaciones
        $datos = session('recuperacion');
        // Si no hay una sesion activa devuelve a la vista de olvidar contraseña
        if (!$datos) {
            return redirect()
                ->route('contrasenas', ['accion' => 'olvidarContrasena'])
                ->withErrors(['correo' => 'No hay una solicitud activa.']);
        }
        // Si la fecha actual supera la de creacion del codigo te lanza error y te pide empezar de nuevo
        if (now()->greaterThan($datos['expira_en'])) {
            session()->forget('recuperacion');
            return redirect()
                ->route('contrasenas', ['accion' => 'olvidarContrasena'])
                ->withErrors(['codigo' => 'El código ha expirado. Solicita uno nuevo']);
        }
        // Se convierte el codigo en que escribio en el form en mayusculas si no coincide te lanza error
        if (strtoupper($request->codigo) !== $datos['codigo']) {
            return back()
                ->withErrors(['codigo' => 'El código ingresado es incorrecto.']);
        }
        return redirect()->route('contrasenas', ['accion' => 'nuevaContrasena']);
    }

    /* Funcion para modificar la contraseña a travez del correo que esta en la sesion */
    public function nuevaContrasena(Request $request)
    {
        $request->validate([
            'contrasena' => 'required|min:8',
            'confirmar_contrasena' => 'required|min:8',
        ], [
            'contrasena.required' => 'La contraseña es obligatoria',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres una mayuscla, minuscula y un numero',
            'confirmar_contrasena.required' => 'La confirmación de la contraseña es obligatoria',
            'confirmar_contrasena.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres',
        ]);
        // Se comparan los dos datos ingresados si no coincide te lanza error
        if ($request->contrasena !== $request->confirmar_contrasena) {
            return back()
                ->withErrors(['confirmar_contrasena' => 'No coinciden las contraseñas'])
                ->withInput();
        }
        $datos = session('recuperacion');
        // Si no hay sesion activa te devuelve error
        if (!$datos) {
            return redirect()
                ->route('contrasenas', ['accion' => 'olvidarContrasena'])
                ->withErrors(['correo' => 'No hay una solicitud activa.']);
        }
        // Se obtiene el correo para hacer la consulta y cambio de contraseña
        $correo = $datos['correo'];
        // Se hace la consulta en la tabla usuario en caso de que el correo sea de un usuario si no entonces se hace en la tabla negocio
        $usuario = Usuario::where('correo', $correo)->first();
        if ($usuario) {
            $usuario->update([
                'contrasena' => Hash::make($request->contrasena)
            ]);
        } else {
            $establecimiento = Establecimiento::where('correo', $correo)
                ->with('negocio')
                ->firstOrFail();
            if ($establecimiento && $establecimiento->negocio) {
                $establecimiento->negocio->contrasena = Hash::make($request->contrasena);
                $establecimiento->negocio->save();
            } else {
                return back()->withErrors(['correo' => 'No se encontró el negocio asociado al correo.']);
            }
        }
        session()->forget('recuperacion');
        return redirect()->route('login')->with('status', 'Contraseña actualizada correctamente.');
    }

    public function reenviarCodigo()
    {
        $datos = session('recuperacion');

        if (!$datos || !isset($datos['correo'])) {
            return response()->json([
                'success' => false,
                'message' => 'No hay una solicitud activa para reenviar el código.'
            ], 400);
        }

        $correo = $datos['correo'];
        $codigo = strtoupper(Str::random(8));

        try {
            Mail::to($correo)->send(new RecuperacionCodigoMail($codigo, 5));

            // Actualiza la sesión con el nuevo código
            session([
                'recuperacion' => [
                    'correo' => $correo,
                    'codigo' => $codigo,
                    'expira_en' => now()->addMinutes(5)
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Se ha reenviado el código al correo.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al reenviar código: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el código. Intente más tarde.'
            ], 500);
        }
    }
    /* Funcion para mostrar las vistas necesarias para modificar la contraseña olvidada de un usuario o negocio */
    public function contrasenasOlvidadas($accion = null)
    {
        $contrasenaUsersView = GlobalVariables::$contrasenaUsersView;
        $codigoUsersView = GlobalVariables::$codigoUsersView;
        $nuevaContrasenaUsersView = GlobalVariables::$nuevaContrasenaUsersView;
        if ($accion === 'olvidarContrasena') {
            return view($contrasenaUsersView);
        } elseif ($accion === 'codeVerificacion') {
            return view($codigoUsersView);
        } elseif ($accion === 'nuevaContrasena') {
            return view($nuevaContrasenaUsersView);
        }
    }
}
