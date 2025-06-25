<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        return view('partials/nav_home')
                .view('principal')
                .view("partials/footer.php");
    }

    public function quienes_somos(){
        return view('partials/nav_home')
                .view('quienes_somos')
                .view("partials/footer.php");
    }
    
    public function comercializacion(){
        return view('partials/nav_home')
                .view('comercializacion')
                .view("partials/footer.php");
    }

    public function informacion_contacto(){
        return view('partials/nav_home')
                .view('informacion_contacto')
                .view("partials/footer.php");
    }

    public function terminos_uso(){
        return view('partials/nav_home')
                .view('terminos_uso')
                .view("partials/footer.php");
    }

    public function consultas(){
        return view('partials/nav_home')
                .view('consultas')
                .view("partials/footer.php");
    }

    // Estas páginas no necesitan el navbar principal
    public function gracias()
    {
        return view('gracias.php');
    }

    public function encriptar()
    {
        return view('encriptar.php');         
    }
}