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
        
        //Este middleware solo procura validar si ha iniciado sessión alguien x 
        
           if(Auth::guard('usuario')->check()){
              if($request->is('usuarios/*')){
                return $next($request);
              }else{
                return redirect()->route('landing');
              }
               
           }
           if (Auth::guard('negocio')->check()) {
            if ($request->is('negocio/*') || $request->is('admin') || $request->is('admin/*') 
            ||  $request->is('productos/*') || $request->is('categorias/*') || $request->is('servicios/*')
            ||  $request->is('staff/*')  ) {
                Log::info('Acceso permitido a: ' . $request->path());
                return $next($request);
            }
            Log::info('Acceso denegado a: ' . $request->path());
            return redirect()->route('landing');
        }
    
        session()->flush();
        return redirect()->route('login');
        
        
    }
}
