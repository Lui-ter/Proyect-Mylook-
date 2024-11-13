<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewsController extends Controller
{
    public function showIndexPrincipal()
    {
        return view('Index.indexBienvenida'); 
    }

    public function showLoginPrincipal(){
        return view('Formularios.formLoginPrincipal');
    }
}
