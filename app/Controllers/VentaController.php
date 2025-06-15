<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductoModel;

class VentaController extends BaseController
{
    private $data;

    public function __construct()
    {
        helper(['session', 'url', 'form']);
        // Carga el navbar correspondiente para todas las vistas
        if (session()->get('logueado') && session()->get('rol') === 'admin') {
            $this->data['nav_view'] = 'partials/nav_admin';
        } else {
            $this->data['nav_view'] = 'partials/nav_home';
        }
    }

    /**
     * Muestra el historial de ventas del usuario logueado.
     */
    public function index()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver tu historial de compras.');
        }

        $ventaModel = new VentaModel();
        $usuarioId = session()->get('id');
        $this->data['ventas'] = $ventaModel->obtenerVentasPorUsuario($usuarioId);

        // --- AJUSTE IMPORTANTE AQUÍ ---
        // Armamos la página completa uniendo las vistas
        return view($this->data['nav_view'])
             . view('ventas/index', $this->data)
             . view('partials/footer');
    }

    /**
     * Muestra los detalles de una venta específica.
     */
    public function ver($ventaId = null)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver los detalles de la compra.');
        }

        $ventaModel = new VentaModel();
        $detalleVentaModel = new DetalleVentaModel();
        $productoModel = new ProductoModel();
        $usuarioId = session()->get('id');
        $venta = $ventaModel->find($ventaId);

        if (!$venta || ($venta['usuario_id'] != $usuarioId && session()->get('rol') !== 'admin')) {
            return redirect()->to('/ventas')->with('error', 'No tienes permiso para ver esta venta o la venta no existe.');
        }

        $detalles = $detalleVentaModel->where('venta_id', $ventaId)->findAll();
        foreach ($detalles as &$detalle) {
            $producto = $productoModel->find($detalle['producto_id']);
            $detalle['producto_nombre'] = $producto ? $producto['nombre'] : 'Producto no encontrado';
        }

        $this->data['venta'] = $venta;
        $this->data['detalles'] = $detalles;
        
        // --- AJUSTE IMPORTANTE AQUÍ ---
        // Armamos la página completa uniendo las vistas
        return view($this->data['nav_view'])
             . view('ventas/detalle', $this->data)
             . view('partials/footer');
    }
    
    public function gestion_ventas()
    {
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $ventaModel = new \App\Models\VentaModel();
        $this->data['ventas'] = $ventaModel->obtenerTodasLasVentasConUsuario();

        return view($this->data['nav_view'])
            . view('ventas/gestion_ventas', $this->data)
            . view('partials/footer');
    }
}