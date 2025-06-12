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

    //Obtener una categoría por ID
    public function obtenerCategoriaPorId($id){
        return $this->find($id);
    }

    // Obtener todas las categorías alfabeticamente
    public function obtenerCategorias(){
        return $this->orderBy('nombre', 'ASC')->findAll();
    }

    public function eliminarCategoria($id){
        return $this->update($id, ['estado' => 0]);
    }
}