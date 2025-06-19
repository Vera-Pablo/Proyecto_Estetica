<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaDetalleModel extends Model
{
    protected $table = 'venta_detalles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio_unitario'];


    public function obtenerDetallesPorVentaId($ventaId){
        return $this->select('detalle_venta.*, p.nombre as producto_nombre, p.imagen as producto_imagen')
                    ->join('producto p', 'p.id = detalle_venta.producto_id', 'left') 
                    ->where('detalle_venta.venta_id', $ventaId)
                    ->findAll();
    }

    /** public function obtenerDetallesPorVenta($ventaId)
    {
        return $this->where('venta_id', $ventaId)->findAll();
    }*/
    
    // Registrar múltiples productos vendidos en una venta
    public function registrarDetalleVenta($datos)
    {
        return $this->insertBatch($datos);
    }
}
