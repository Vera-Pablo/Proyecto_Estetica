<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'total', 'metodo_pago', 'estado', 'fecha'];

    public function obtenerVentasPorUsuario($filtros = []){
            $builder = $this->db->table('ventas')
            ->select('ventas.*, usuarios.nombre as cliente_nombre, usuarios.apellido as cliente_apellido')
            ->join('usuarios', 'usuarios.id = ventas.usuario_id');

        if (!empty($filtros['fecha_inicio'])) {
            $builder->where('ventas.fecha >=', $filtros['fecha_inicio']);
        }
        if (!empty($filtros['fecha_fin'])) {
            $builder->where('ventas.fecha <=', $filtros['fecha_fin']);
        }
        if (!empty($filtros['cliente_id'])) {
            $builder->where('ventas.usuario_id', $filtros['cliente_id']);
        }

        return $builder->get()->getResultArray();
    }


    public function obtenerTodasLasVentasConUsuario($filtros = []){
        $builder = $this->db->table('ventas')
            ->select('ventas.*, usuarios.nombre as cliente_nombre, usuarios.apellido as cliente_apellido')
            ->join('usuarios', 'usuarios.id = ventas.usuario_id');

        if (!empty($filtros['fecha_inicio'])) {
            $builder->where('ventas.fecha >=', $filtros['fecha_inicio']);
        }
        if (!empty($filtros['fecha_fin'])) {
            $builder->where('ventas.fecha <=', $filtros['fecha_fin']);
        }
        if (!empty($filtros['cliente_id'])) {
            $builder->where('ventas.usuario_id', $filtros['cliente_id']);
        }

        return $builder->get()->getResultArray();
    }
}
