<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DetalleVentaModel; // Import DetalleVentaModel

class VentaModel extends Model
{
    protected $table            = 'venta'; // Nombre de la tabla
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;

    protected $allowedFields    = [
        'usuario_id',
        'total',
        'fecha' // Tu campo 'fecha' de la tabla
    ];

    // No se usan $useTimestamps aquí a menos que tengas created_at/updated_at
    // para el registro de la venta en sí, además del campo 'fecha'.
    // protected $useTimestamps = false;

    /**
     * Crea una nueva venta y sus detalles (transaccional).
     * @param array $datosVenta Datos para la tabla 'venta'.
     * @param array $itemsDetalle Array de ítems para 'detalle_venta'.
     * @return int|false El ID de la venta creada o false si falla.
     */
    public function crearVentaConDetalles($datosVenta, $itemsDetalle)
    {
        $this->db->transStart();

        $idVenta = $this->insert($datosVenta, true); // El 'true' devuelve el ID

        if (!$idVenta) {
            $this->db->transRollback();
            log_message('error', 'Error al guardar venta principal: ' . json_encode($this->errors()));
            return false;
        }

        $detalleVentaModel = new DetalleVentaModel();  //Asegúrate que este modelo exista
        $productoModel = new \App\Models\ProductoModel(); // Para actualizar stock

        foreach ($itemsDetalle as $item) {
            $item['venta_id'] = $idVenta;
            if (!$detalleVentaModel->insert($item)) {
                $this->db->transRollback();
                log_message('error', 'Error al guardar detalle de venta: ' . json_encode($detalleVentaModel->errors()));
                return false;
            }
            // Actualizar stock del producto (asumiendo que tienes un método en ProductoModel)
            // Necesitarás el ProductoModel aquí si quieres actualizar stock
            // Ejemplo: $productoModel->actualizarStock($item['producto_id'], -$item['cantidad']);
            if (method_exists($productoModel, 'actualizarStock')) {
                if (!$productoModel->actualizarStock($item['producto_id'], -$item['cantidad'])) {
                    $this->db->transRollback();
                    log_message('error', 'Error al actualizar stock para producto ID: ' . $item['producto_id']);
                    return false;
                }
            } else {
                log_message('warning', 'El método actualizarStock no existe en ProductoModel.');
            }

        }

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            log_message('error', 'Transacción de creación de venta fallida.');
            return false;
        }

        $this->db->transCommit();
        return $idVenta;
    }

    /**
     * Obtiene las ventas de un usuario específico.
     * @param int $usuarioId
     * @return array|null
     */
    public function obtenerVentasPorUsuario($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                    ->orderBy('fecha', 'DESC')
                    ->findAll();
    }

    /**
     * Obtiene una venta por su ID.
     * @param int $id
     * @return object|null
     */
    public function obtenerVentaPorId($id)
    {
        return $this->find($id);
    }
}