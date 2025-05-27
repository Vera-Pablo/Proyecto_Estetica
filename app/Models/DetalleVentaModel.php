<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVentaModel extends Model
{
    protected $table            = 'detalle_venta'; // Nombre de la tabla
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;

    protected $allowedFields    = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario' // Como en tu schema
    ];

    // No se usan $useTimestamps aquí a menos que tengas created_at/updated_at
    // protected $useTimestamps = false;

    /**
     * Obtiene todos los detalles de una venta específica.
     * @param int $ventaId
     * @return array|null
     */
    public function obtenerDetallesPorVentaId($ventaId)
    {
        // Ejemplo de join para obtener el nombre del producto
        return $this->select('detalle_venta.*, p.nombre as producto_nombre, p.imagen as producto_imagen')
                    ->join('producto p', 'p.id = detalle_venta.producto_id', 'left') // Asumiendo tabla 'producto'
                    ->where('detalle_venta.venta_id', $ventaId)
                    ->findAll();
    }
}