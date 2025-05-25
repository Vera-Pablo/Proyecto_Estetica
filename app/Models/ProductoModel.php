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
        'categoria_id'
    ];

    //Buscar por nombre (para buscador en el catálogo)
    public function buscarPorNombre($texto)
    {
        return $this->like('nombre', $texto)->findAll();
    }

    //Filtrar por categoría
    public function filtrarPorCategoria($categoria_id)
    {
        return $this->where('categoria_id', $categoria_id)->findAll();
    }

    //Obtener todos los productos con una cantidad opcional
    public function obtenerProductos($limite = null)
    {
        return $limite ? $this->limit($limite)->findAll() : $this->findAll();
    }

    //Obtener un solo producto por ID
    public function obtenerProducto($id)
    {
        return $this->find($id);
    }

    //FUNCIONES PARA EL ADMINISTRADOR
    //Crea producto
    
}


