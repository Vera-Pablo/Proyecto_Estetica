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
        // Verificar si el usuario está logueado
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver tus favoritos.');
        }

        $favoritoModel = new FavoritoModel();
        $usuarioId = session()->get('id');

        $data['favoritos'] = $favoritoModel->obtenerFavoritosPorUsuario($usuarioId);
        
        // Cargar una vista para mostrar los favoritos
        // return view('frontend/favoritos/index_view', $data); // Ejemplo de vista
        // Por ahora, solo para probar:
        echo "<h1>Mis Favoritos</h1>";
        if (!empty($data['favoritos'])) {
            echo "<ul>";
            foreach ($data['favoritos'] as $fav) {
                echo "<li>{$fav->producto_nombre} - \${$fav->precio} 
                      <a href='".site_url('/favoritos/eliminar/'.$fav->producto_id)."'>Eliminar</a>
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No tienes productos favoritos.</p>";
        }
        // todo: Crear y retornar la vista adecuada, ej:
        // return view('path/to/your/favoritos_view', $data);
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

        if ($favoritoModel->eliminarFavoritoPorProducto($usuarioId, $productoId)) {
            return redirect()->to('/favoritos')->with('mensaje', 'Producto eliminado de tus favoritos.');
        } else {
            return redirect()->to('/favoritos')->with('error', 'No se pudo eliminar el producto de favoritos o no estaba en la lista.');
        }
    }
}