<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoritoModel extends Model
{
    protected $table            = 'favorito'; // Nombre de la tabla como en tu ejemplo de CategoriaModel
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;

    protected $allowedFields    = [
        'usuario_id',
        'producto_id',
        // 'agregado_en' // Se maneja con $createdField si usas timestamps
    ];

    // Timestamps, usando tu campo 'agregado_en'
    protected $useTimestamps = true;
    protected $createdField  = 'agregado_en';
    protected $updatedField  = false; // No hay campo de actualización en tu schema para favoritos

    /**
     * Obtiene los productos favoritos de un usuario, incluyendo datos del producto.
     * @param int $usuarioId ID del usuario.
     * @return array|null
     */
    public function obtenerFavoritosPorUsuario($usuarioId)
    {
        return $this->select('favorito.*, p.nombre as producto_nombre, p.precio, p.imagen as producto_imagen') // Asumiendo 'precio' en tabla producto
                    ->join('producto p', 'p.id = favorito.producto_id') // Asumiendo tabla 'producto'
                    ->where('favorito.usuario_id', $usuarioId)
                    ->orderBy('favorito.agregado_en', 'DESC')
                    ->findAll();
    }

    /**
     * Verifica si un producto ya es favorito de un usuario.
     * @param int $usuarioId
     * @param int $productoId
     * @return bool
     */
    public function esFavorito($usuarioId, $productoId)
    {
        return $this->where('usuario_id', $usuarioId)
                    ->where('producto_id', $productoId)
                    ->countAllResults() > 0;
    }

    /**
     * Elimina un favorito basado en usuario_id y producto_id.
     * @param int $usuarioId
     * @param int $productoId
     * @return bool
     */
    public function eliminarFavoritoPorProducto($usuarioId, $productoId)
    {
        return $this->where('usuario_id', $usuarioId)
                    ->where('producto_id', $productoId)
                    ->delete();
    }
}