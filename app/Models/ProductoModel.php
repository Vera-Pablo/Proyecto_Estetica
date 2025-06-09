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

    // Crear producto
    public function crearProducto($data){
        return $this->insert($data);
    }

    //Guardar producto
    public function guardar(){
        $productoModel = new ProductoModel();

        $data = [
            'nombre'       => $this->request->getPost('nombre'),
            'descripcion'  => $this->request->getPost('descripcion'),
            'precio'       => $this->request->getPost('precio'),
            'stock'        => $this->request->getPost('stock'),
            'imagen'       => $this->request->getPost('imagen'),
            'categoria_id' => $this->request->getPost('categoria_id')
        ];
        // Insertar producto
        $productoModel->crearProducto($data);

        return redirect()->to('/productos')->with('mensaje', 'Producto creado exitosamente.');
    }

    // Actualizar producto
    public function actualizarProducto($id, $data){
        return $this->update($id, $data);
    }

    // Eliminar producto
    public function eliminarProducto($id){
        return $this->delete($id);
    }

    //Buscar por nombre
    public function buscarPorNombre($texto){
        return $this->select('productos.*, categoria.nombre as categoria')
                ->join('categoria', 'categoria.id = productos.categoria_id')
                ->like('productos.nombre', $texto)
                ->findAll();
    }

    //Obtener un solo producto por ID
    public function obtenerProductoId($id){
        return $this->find($id);
    }

    //Obtener todos los productos activos 
    public function obtenerProductos(){
         //return $this->where('estado', 1)->findAll(); // Solo productos activos
         return $this->select('productos.*, categoria.nombre as categoria')
                ->join('categoria', 'categoria.id = productos.categoria_id')
                ->findAll();
    }

}


