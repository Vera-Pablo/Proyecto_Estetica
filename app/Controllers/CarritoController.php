<?php

namespace App\Controllers;

use App\Models\CarritoModel;
use App\Models\ProductoModel;

class CarritoController extends BaseController
{
    // Ver carrito del usuario actual (logueado o visitante)
// En app/Controllers/CarritoController.php

    public function index(){
        if (!session()->get('logueado') || session()->get('rol') == 'admin') {
            return redirect()->to('/panel_admin')->with('error', 'Acceso no autorizado.');
        }
        
        $carritoModel = new CarritoModel();
        $productoModel = new ProductoModel();

        $usuarioId = session('id');
        
        $items = $usuarioId ? $carritoModel->obtenerCarritoPorUsuario($usuarioId) : [];

        // Cargar datos completos de cada producto en el carrito
        if(!empty($items)){
            foreach ($items as &$item) { 
                $item['producto'] = $productoModel->obtenerProductoId($item['producto_id']);
            }
        }
        
        $data['items'] = $items;

        return view('partials/nav_home')
            . view('carrito/index', $data)
            . view('partials/footer');
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

    public function actualizar(){
        $carritoModel = new \App\Models\CarritoModel();
        $productoModel = new \App\Models\ProductoModel();
        $cantidades = $this->request->getPost('cantidades');

        foreach ($cantidades as $carritoId => $nuevaCantidad) {
            $item = $carritoModel->find($carritoId);
            if ($item) {
                $producto = $productoModel->find($item['producto_id']);
                if ($producto && $nuevaCantidad > $producto['stock']) {
                    return redirect()->back()->with('mensaje', 'Stock insuficiente para ' . esc($producto['nombre']));
                }
                $carritoModel->update($carritoId, ['cantidad' => $nuevaCantidad]);
            }
        }
        return redirect()->back()->with('mensaje', 'Carrito actualizado correctamente.');
    }
}
