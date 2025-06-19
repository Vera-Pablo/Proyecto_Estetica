<?php

namespace App\Controllers;

use App\Models\CarritoModel;
use App\Models\ProductoModel;

class CarritoController extends BaseController
{
    // Ver carrito del usuario actual (logueado o visitante)
// En app/Controllers/CarritoController.php

    public function index()
    {
        $carritoModel = new CarritoModel();
        $productoModel = new ProductoModel();

        $usuarioId = session('id');
        
        // Tu lógica original era para una sesión de visitante, la ajustamos para usuario logueado
        // Nota: El CarritoModel que me pasaste no tiene método para sesión de visitante.
        $items = $usuarioId ? $carritoModel->obtenerCarritoPorUsuario($usuarioId) : [];

        // Cargar datos completos de cada producto en el carrito
        if(!empty($items)){
            foreach ($items as &$item) { // El & permite modificar el array original
                // Corregí el nombre de la función aquí
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

        public function actualizar()
    {
        $carritoModel = new CarritoModel();
        $cantidades = $this->request->getPost('cantidades');

        if (!empty($cantidades)) {
            foreach ($cantidades as $carritoId => $cantidad) {
                // Actualiza la cantidad para cada item del carrito
                $carritoModel->update($carritoId, ['cantidad' => $cantidad]);
            }
            return redirect()->to('/carrito')->with('mensaje', 'Carrito actualizado correctamente.');
        }

        return redirect()->to('/carrito')->with('error', 'No se recibieron datos para actualizar.');
    }
}
