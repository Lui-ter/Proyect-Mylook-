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
            //Protege si intenta acceder a otra ruta con el token
            
              if($request->is('usuarios/*')){
                return $next($request);
              }else{
                return redirect()->route('landing');
              }
               
           }
        }
        Log::info('Verificando sesión en middleware:', [
            'has_session' => session()->has('id_negocio'),
            'session_id' => session()->getId(),
            'usuario_auth' => Auth::guard('negocio')->check(),
            'session_data' => session()->all(),
            'auth_user' => Auth::guard('negocio')->user(),
            'method' => $request->method(),
            'url' => $request->url()
        ]);
        if(session()->has('id_negocio')){
            if(Auth::guard('negocio')->check()){
                if($request->is('negocio/*')){
                    return $next($request);
                }else{
                    return redirect()->route('landing');
                  }
                
            }
        }
           
        session()->flush();
        return redirect()->route('login');
        
        
    }
}
