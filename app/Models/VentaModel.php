<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DetalleVentaModel; 

class VentaModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'total', 'fecha'];

    // Esta función está bien, no se toca
    public function obtenerVentasPorUsuario($usuarioId){
        return $this->where('usuario_id', $usuarioId)->orderBy('fecha', 'DESC')->findAll();
    }

    // Esta función está bien, no se toca
    public function obtenerVentaPorId($id){
        return $this->find($id);
    }
    
    /**
     * Registra una venta y sus detalles usando una transacción.
     * Si algo falla, se revierte toda la operación.
     * @param array $datosVenta Datos de la tabla 'ventas'.
     * @param array $itemsDetalle Array con los productos del detalle.
     * @return int|false El ID de la venta creada o false si falla.
     */
    public function crearVentaConDetalles(array $datosVenta, array $itemsDetalle)
    {
        $detalleVentaModel = new DetalleVentaModel();
        
        // Iniciamos la transacción
        $this->db->transStart();

        // 1. Insertar la venta principal
        $this->insert($datosVenta);

        // 2. Obtener el ID de la venta que acabamos de crear
        $ventaId = $this->getInsertID();

        // 3. Preparar y guardar cada detalle
        foreach ($itemsDetalle as $item) {
            $item['venta_id'] = $ventaId; // Añadimos el ID de la venta a cada detalle
            $detalleVentaModel->insert($item);
            
            // Aquí podrías añadir la lógica para descontar el stock del producto
        }
        
        // Finalizamos la transacción
        $this->db->transComplete();

        // Verificamos si la transacción fue exitosa
        if ($this->db->transStatus() === false) {
            return false; // La transacción falló
        }

        return $ventaId; // La transacción fue exitosa, devolvemos el ID de la venta
    }

    // Pega esta nueva función dentro de tu clase VentaModel en app/Models/VentaModel.php

    public function obtenerTodasLasVentasConUsuario()
    {
        return $this->select('ventas.*, usuarios.nombre as nombre_usuario, usuarios.apellido as apellido_usuario')
                    ->join('usuarios', 'usuarios.id = ventas.usuario_id')
                    ->orderBy('ventas.fecha', 'DESC')
                    ->findAll();
    }
}