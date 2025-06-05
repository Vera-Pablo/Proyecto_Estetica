<?php

namespace App\Controllers;

use App\Models\CarritoModel;
use App\Models\ProductoModel;

class CarritoController extends BaseController
{
    // Ver carrito del usuario actual (logueado o visitante)
    public function index()
    {
        $carritoModel = new CarritoModel();
        $productoModel = new ProductoModel();

        $usuarioId = session('id');
        $sessionId = session_id();

        $items = $usuarioId
            ? $carritoModel->obtenerCarritoPorUsuario($usuarioId)
            : $carritoModel->obtenerCarritoPorSession($sessionId);

        // Cargar datos de productos
        foreach ($items as &$item) {
            $item['producto'] = $productoModel->obtenerProducto($item['producto_id']);
        }

        return view('carrito/index', ['items' => $items]);
    }

    // Agregar producto al carrito
    public function agregar()
    {
        $carritoModel = new CarritoModel();

        $usuarioId = session('id');
        $sessionId = session_id();

        $data = [
            'usuario_id' => $usuarioId ?? null,
            'session_id' => $usuarioId ? null : $sessionId,
            'producto_id' => $this->request->getPost('producto_id'),
            'cantidad' => $this->request->getPost('cantidad') ?? 1
        ];

        $carritoModel->agregarProducto($data);
        return redirect()->to('/carrito')->with('mensaje', 'Producto agregado al carrito.');
    }

    // Quitar producto del carrito
    public function eliminar($id)
    {
        $carritoModel = new CarritoModel();
        $carritoModel->eliminarProducto($id);

        return redirect()->to('/carrito')->with('mensaje', 'Producto eliminado del carrito.');
    }
}
