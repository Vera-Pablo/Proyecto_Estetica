<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DetalleVentaModel; 

class VentaModel extends Model
{
    protected $table = 'ventas'; // Nombre de la tabla
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id',
        'total',
        'fecha' // Tu campo 'fecha' de la tabla
    ];

    public function obtenerVentasPorUsuario($usuarioId){
        return $this->where('usuario_id', $usuarioId)->orderBy('fecha', 'DESC')->findAll();
    }

    public function obtenerVentaPorId($id){
        return $this->find($id);
    }

    public function registrarVenta($data){
        return $this->getInsertID();
    }
}