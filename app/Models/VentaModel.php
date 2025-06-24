<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'total', 'metodo_pago', 'estado', 'fecha'];

    public function obtenerVentasPorUsuario($usuarioId){
        return $this->where('usuario_id', $usuarioId)->findAll();
    }
}