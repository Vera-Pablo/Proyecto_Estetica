<?php

namespace App\Controllers;

use App\Models\FavoritoModel;
use App\Models\ProductoModel; // Para verificar si el producto existe

class FavoritoController extends BaseController
{
    public function __construct()
    {
        // Cargar helper de sesión o asegurarse que esté autocargado
        helper(['session', 'url']);
    }

    /**
     * Muestra los productos favoritos del usuario logueado.
     */
    public function index()
    {
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
    public function agregar($productoId = null)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para agregar favoritos.');
        }

        if ($productoId === null) {
            return redirect()->back()->with('error', 'Producto no especificado.');
        }

        $productoModel = new ProductoModel();
        $producto = $productoModel->find($productoId);

        if (!$producto) {
            return redirect()->back()->with('error', 'El producto no existe.');
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
            // Log errors: log_message('error', json_encode($favoritoModel->errors()));
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
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }

        $usuarioId = session()->get('id');
        $favoritoModel = new \App\Models\FavoritoModel();
        $carritoModel = new \App\Models\CarritoModel();

        // 1. Obtener todos los productos favoritos del usuario
        $favoritos = $favoritoModel->where('usuario_id', $usuarioId)->findAll();

        if (empty($favoritos)) {
            return redirect()->to('/favoritos')->with('info', 'Tu lista de favoritos ya estaba vacía.');
        }

        $productosAgregados = 0;
        // 2. Recorrer cada favorito y agregarlo al carrito
        foreach ($favoritos as $favorito) {
            $data = [
                'usuario_id'  => $usuarioId,
                'producto_id' => $favorito['producto_id'],
                'cantidad'    => 1 // Se agrega una unidad por defecto
            ];
            // Usamos el método que ya tenías en tu CarritoModel
            if ($carritoModel->agregarProducto($data)) {
                $productosAgregados++;
            }
        }
        
        // 3. Redirigir al carrito con un mensaje de éxito
        return redirect()->to('/carrito')->with('mensaje', $productosAgregados . ' producto(s) de tu lista de favoritos han sido agregados al carrito.');
    }
}