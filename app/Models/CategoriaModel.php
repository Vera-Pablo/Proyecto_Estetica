<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'categoria';
    
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre'
    ];

    // Método para obtener todas las categorías alfabeticamente
    public function obtenerCategorias()
    {
        return $this->orderBy('nombre', 'ASC')->findAll();
    }

    public function obtenerCategoriaPorId($id)
    {
        return $this->find($id);
    }
}