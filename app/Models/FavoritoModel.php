<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoritoModel extends Model
{
    protected $table = 'favoritos'; 
    protected $primaryKey = 'id';         
    protected $allowedFields = [
        'usuario_id',
        'producto_id',
        'agregado_en'
    ];

    // Obtener todos los favoritos de un usuario
    // Obtener todos los productos favoritos de un usuario con sus detalles
    public function obtenerFavoritosPorUsuario($usuarioId)
    {
        return $this->select('productos.id as producto_id, productos.nombre as producto_nombre, productos.precio, productos.imagen')
                    ->join('productos', 'productos.id = favoritos.producto_id')
                    ->where('favoritos.usuario_id', $usuarioId)
                    ->findAll();
    }
    // Verificar si un producto ya está marcado como favorito
    public function esFavorito($usuarioId, $productoId)
    {
        return $this
            ->where('usuario_id', $usuarioId)
            ->where('producto_id', $productoId)
            ->first();
    }

    // Agregar producto a favoritos
    public function agregarFavorito($usuarioId, $productoId)
    {
        if (!$this->esFavorito($usuarioId, $productoId)) {
            return $this->insert([
                'usuario_id' => $usuarioId,
                'producto_id' => $productoId,
            ]);
        }
        return false; // ya es favorito
    }

    // Quitar producto de favoritos
    public function eliminarFavorito($usuarioId, $productoId)
    {
        return $this
            ->where('usuario_id', $usuarioId)
            ->where('producto_id', $productoId)
            ->delete();
    }
}
