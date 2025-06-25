<?php

namespace App\Models;

use CodeIgniter\Model;

class CarritoModel extends Model
{
    protected $table = 'carrito';
    
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'usuario_id',
        'session_id',
        'producto_id',
        'cantidad',
    ];

    //obtener carrito de usuario logueado
    public function obtenerCarritoPorUsuario($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)->findAll();
    }

    //obtener carrito por session_id
    public function obtenerCarritoPorSession($sessionId)
    {
        return $this->where('session_id', $sessionId)->findAll();
    }

    //verificar si un producto ya está en el carrito
    public function productoEnCarrito($usuarioId, $productoId)
    {
        return $this->where([
            'usuario_id' => $usuarioId,
            'producto_id' => $productoId
        ])->first();
    }

    //agregar producto al carrito
    public function agregarProducto($data)
    {
        //actualizar cantidad si el producto ya existe en el carrito
        $registro = $this 
        -> where('usuario_id', $data['usuario_id'])
        -> where('producto_id', $data['producto_id'])
        -> first();
        
        if($registro){
            $nuevaCantidad = $registro['cantidad'] + $data['cantidad'];
            return $this->update($registro['id'], ['cantidad' => $nuevaCantidad]);
        }   else{
            return $this->insert($data);
        }
    }

    //eliminar producto del carrito
    public function eliminarProducto($id)
    {
        return $this->delete($id);
    }

    public function limpiarCarrito($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)->delete();
    }
}