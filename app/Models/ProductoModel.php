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
        return $this->update($id, ['estado' => 0]);
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
        // Dentro de la clase ProductoModel
    public function actualizarStock($id, $cantidadComprada)
    {
        $this->set('stock', "stock - $cantidadComprada", false);
        $this->where('id', $id);
        return $this->update();
    }   

        /**
     * Obtiene solo los productos activos (estado = 1) de categorías activas.
     * Ideal para el catálogo público.
     */
    public function obtenerProductosActivos()
    {
        return $this->select('productos.*, categoria.nombre as categoria_nombre, categoria.estado as categoria_estado')
                    ->join('categoria', 'categoria.id = productos.categoria_id')
                    ->where('productos.estado', 1) // Condición 1: El producto debe estar activo
                    ->where('categoria.estado', 1)  // Condición 2: La categoría del producto también debe estar activa
                    ->findAll();
    }

}


