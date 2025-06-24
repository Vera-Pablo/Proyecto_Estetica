<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaDetalleModel extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id';
    protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio_unitario'];
}   