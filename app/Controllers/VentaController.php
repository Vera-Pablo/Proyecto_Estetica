<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\VentaModel;
use App\Models\VentaDetalleModel;
use App\Models\ProductoModel;
use App\Models\CarritoModel;

class VentaController extends BaseController
{
    //Muestra la vista de historial de compras del usuario
    public function index(){
        $ventaModel = new VentaModel();
        $usuarioId = session()->get('id');
        $data['ventas'] = $ventaModel->obtenerVentasPorUsuario($usuarioId);

        // Obtener clientes 
        $usuarioModel = new UsuarioModel();
        $data['clientes'] = $usuarioModel->findAll();

        return view('ventas/gestion_ventas', $data);
    }
}