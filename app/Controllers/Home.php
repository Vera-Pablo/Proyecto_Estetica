<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $data; // Usaremos un array para pasar datos a las vistas

    public function __construct()
    {
        // Esta función se ejecuta automáticamente antes que cualquier otra.
        // Aquí decidimos qué navbar usar y lo guardamos para después.
        if (session()->get('logueado') && session()->get('rol') === 'admin') {
            $this->data['nav_view'] = 'partials/nav_admin'; // El navbar para admin
        } else {
            $this->data['nav_view'] = 'partials/nav_home'; // El navbar para el resto
        }
    }

    public function index()
    {
        return view($this->data['nav_view'])
                .view('principal')
                .view("partials/footer.php");
    }

    public function quienes_somos()
    {
        return view($this->data['nav_view'])
                .view('quienes_somos')
                .view("partials/footer.php");
    }
    
    public function comercializacion()
    {
        return view($this->data['nav_view'])
                .view('comercializacion')
                .view("partials/footer.php");
    }

    public function informacion_contacto()
    {
        return view($this->data['nav_view'])
                .view('informacion_contacto')
                .view("partials/footer.php");
    }

    public function terminos_uso()
    {
        return view($this->data['nav_view'])
                .view('terminos_uso')
                .view("partials/footer.php");
    }

    public function consultas()
    {
        return view($this->data['nav_view'])
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