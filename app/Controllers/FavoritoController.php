<?php

namespace App\Controllers;

use App\Models\FavoritoModel;
use App\Models\ProductoModel; // Para verificar si el producto existe
use App\Models\CarritoModel;

class FavoritoController extends BaseController
{
    public function __construct(){
        // Cargar helper de sesión o asegurarse que esté autocargado
        helper(['session', 'url']);
    }

    /**
     * Muestra los productos favoritos del usuario logueado.
     */
    public function index(){
        if (!session()->get('logueado') || session()->get('rol') == 'admin') {
            return redirect()->to('/panel_admin')->with('error', 'Acceso no autorizado.');
        }
        
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver tus favoritos.');
        }

        $favoritoModel = new FavoritoModel();
        $usuarioId = session()->get('id');
        
        // Usamos el método que ya tenías para obtener los favoritos con datos del producto
        $data['favoritos'] = $favoritoModel->obtenerFavoritosPorUsuario($usuarioId);
        
        // Cargamos las vistas en el orden correcto
        return view('partials/nav_home')
            . view('favoritos/index', $data)
            . view('partials/footer');
    }

    /**
     * Agrega un producto a la lista de favoritos del usuario logueado.
     * @param int $productoId ID del producto a agregar.
     */
        public function agregar($productoId)
        {
            $carritoModel = new CarritoModel();
            $productoModel = new ProductoModel();
            $producto = $productoModel->find($productoId);

            if (!$producto) {
                return redirect()->back()->with('error', 'Producto no encontrado.');
            }

            if ($producto['stock'] <= 0) {
                log_message('error', 'Intento de agregar producto sin stock: ' . $productoId);
                return redirect()->back()->with('error', 'No hay stock disponible para este producto.');
            }

            $cantidad = $this->request->getPost('cantidad') ?? 1;

            // Validar que la cantidad no supere el stock
            if ($cantidad > $producto['stock']) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible.');
            }

        $favoritoModel = new FavoritoModel();
        $usuarioId = session()->get('id');

        if ($favoritoModel->esFavorito($usuarioId, $productoId)) {
            return redirect()->back()->with('info', 'Este producto ya está en tus favoritos.');
        }

        $data = [
            'usuario_id'  => $usuarioId,
            'producto_id' => $productoId
        ];

        if ($favoritoModel->insert($data)) {
            return redirect()->back()->with('mensaje', 'Producto agregado a favoritos.');
        } else {
            return redirect()->back()->with('error', 'No se pudo agregar el producto a favoritos.');
        }
    }

    /**
     * Elimina un producto de la lista de favoritos del usuario logueado.
     * Se puede eliminar por ID de favorito o por ID de producto.
     * Aquí se usará el ID del producto para simplificar el enlace desde la lista.
     * @param int $productoId ID del producto a eliminar.
     */
    public function eliminar($productoId = null)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para eliminar favoritos.');
        }

        if ($productoId === null) {
            return redirect()->back()->with('error', 'Producto no especificado para eliminar.');
        }

        $favoritoModel = new FavoritoModel();
        $usuarioId = session()->get('id');

        // CAMBIO: Se ajustó el nombre del método para que coincida con el del Modelo.
        // Antes era: ->eliminarFavoritoPorProducto(...)
        if ($favoritoModel->eliminarFavorito($usuarioId, $productoId)) {
            return redirect()->to('/favoritos')->with('mensaje', 'Producto eliminado de tus favoritos.');
        } else {
            return redirect()->to('/favoritos')->with('error', 'No se pudo eliminar el producto de favoritos o no estaba en la lista.');
        }
    }

        /**
     * Agrega todos los productos favoritos del usuario al carrito.
     */
    public function agregarTodoAlCarrito()
    {
        $favoritoModel = new \App\Models\FavoritoModel();
        $productoModel = new \App\Models\ProductoModel();
        $carritoModel = new \App\Models\CarritoModel();

        $usuarioId = session('id');
        $sessionId = session_id();

        // Trae todos los favoritos del usuario
        $favoritos = $favoritoModel->where('usuario_id', $usuarioId)->findAll();

        $agregados = 0;
        $sinStock = [];
        $yaAlMaximo = [];

        foreach ($favoritos as $fav) {
            $producto = $productoModel->find($fav['producto_id']);
            if ($producto && $producto['stock'] > 0) {
                // Verificar cantidad actual en el carrito
                $itemCarrito = $carritoModel
                    ->where('producto_id', $producto['id'])
                    ->where('usuario_id', $usuarioId)
                    ->first();

                $cantidadEnCarrito = $itemCarrito['cantidad'] ?? 0;

                // Solo agregar si no supera el stock
                if ($cantidadEnCarrito + 1 > $producto['stock']) {
                    $yaAlMaximo[] = $producto['nombre'] ?? 'Producto ID ' . $fav['producto_id'];
                    continue;
                }

                $data = [
                    'usuario_id' => $usuarioId ?? null,
                    'session_id' => $usuarioId ? null : $sessionId,
                    'producto_id' => $producto['id'],
                    'cantidad' => 1
                ];
                $carritoModel->agregarProducto($data);
                $agregados++;
            } else {
                $sinStock[] = $producto['nombre'] ?? 'Producto ID ' . $fav['producto_id'];
            }
        }

        $mensaje = [];
        if ($agregados > 0) {
            $mensaje[] = 'Se agregaron los productos con stock al carrito.';
        }
        if (count($sinStock) > 0) {
            $mensaje[] = 'Sin stock: ' . implode(', ', $sinStock);
        }
        if (count($yaAlMaximo) > 0) {
            $mensaje[] = 'Ya tienes la cantidad máxima en el carrito de: ' . implode(', ', $yaAlMaximo);
        }
        if (empty($mensaje)) {
            $mensaje[] = 'Ningún producto fue agregado porque no hay stock o ya tienes la cantidad máxima en el carrito.';
        }

        return redirect()->to('/favoritos')->with('mensaje', implode(' ', $mensaje));
    }

    /**
     * Elimina todos los productos favoritos del usuario.
     */
    public function eliminarTodo()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para eliminar favoritos.');
        }

        $favoritoModel = new FavoritoModel();
        $usuarioId = session()->get('id');

        if ($favoritoModel->eliminarFavoritosPorUsuario($usuarioId)) {
            return redirect()->to('/favoritos')->with('mensaje', 'Todos los productos han sido eliminados de tus favoritos.');
        } else {
            return redirect()->to('/favoritos')->with('error', 'No se pudieron eliminar los favoritos.');
        }
    }
}