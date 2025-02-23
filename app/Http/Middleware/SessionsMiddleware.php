<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class SessionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        Log::info('Verificando sesión en middleware:', [
            'has_session' => $request->hasSession(),
            'session_id' => session()->getId(),
            'usuario_auth' => Auth::guard('usuario')->check(),
            'session_data' => session()->all()
        ]);
        //Este middleware solo procura validar si ha iniciado sessión alguien x 
        if(session()->has('usuario_id')){
           if(Auth::guard('usuario')->check()){
              
               return $next($request);
           }
        }
        if(session()->has('negocio')){
            if(Auth::guard('negocio')->check()){
                dd('Middleware: Usuario logueado');
                return $next($request);
            }
        }
        
        dd('Middleware: Usuario no logueado');
        session()->flush(); //limpia cualquier session si fallo el login
        return redirect()->route('login');
    }
}
