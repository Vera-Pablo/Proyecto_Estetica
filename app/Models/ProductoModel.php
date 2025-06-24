<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';       
    protected $primaryKey = 'id';         

    protected $allowedFields = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'categoria_id',
        'estado',
    ];

    public function obtenerProductoId($id){
        return $this->find($id);
    }
}


