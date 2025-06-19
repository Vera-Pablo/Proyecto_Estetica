<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'total', 'metodo_pago', 'estado', 'fecha'];

    /**
     * Obtiene todas las ventas y une los datos del usuario.
     */
 /**
     * Obtiene todas las ventas y une los datos del usuario, aplicando filtros opcionales.
     * @param array $filtros Array asociativo con los filtros (ej. 'fecha_inicio', 'cliente_id')
     */
    public function obtenerTodasLasVentasConUsuario($filtros = [])
    {
        $builder = $this->select('ventas.*, usuarios.nombre, usuarios.apellido')
                        ->join('usuarios', 'usuarios.id = ventas.usuario_id');

        // Aplicar filtro de fecha de inicio
        if (!empty($filtros['fecha_inicio'])) {
            $builder->where('ventas.fecha >=', $filtros['fecha_inicio'] . ' 00:00:00');
        }

        // Aplicar filtro de fecha de fin
        if (!empty($filtros['fecha_fin'])) {
            $builder->where('ventas.fecha <=', $filtros['fecha_fin'] . ' 23:59:59');
        }

        // Aplicar filtro por cliente específico
        if (!empty($filtros['cliente_id'])) {
            $builder->where('ventas.usuario_id', $filtros['cliente_id']);
        }

        return $builder->orderBy('ventas.fecha', 'DESC')->findAll();
    }

    /**
     * Obtiene las ventas de un usuario específico.
     */
    public function obtenerVentasPorUsuario($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                    ->orderBy('fecha', 'DESC')
                    ->findAll();
    }
}