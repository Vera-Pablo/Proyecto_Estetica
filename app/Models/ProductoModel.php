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
    // Crear producto
    public function crearProducto($data)
    {
        return $this->insert($data);
    }

    // Actualizar producto
    public function actualizarProducto($id, $data)
    {
        return $this->update($id, $data);
    }

    // Eliminar producto
    public function eliminarProducto($id)
    {
        return $this->delete($id);
    }


    public function guardar()
    {
        $productoModel = new ProductoModel();

        // Armamos el array con los datos del formulario
        $data = [
            'nombre'       => $this->request->getPost('nombre'),
            'descripcion'  => $this->request->getPost('descripcion'),
            'precio'       => $this->request->getPost('precio'),
            'stock'        => 10, // opcional, o podés agregar el campo al formulario
            'imagen'       => $this->request->getPost('imagen'),
            'categoria_id' => $this->request->getPost('categoria_id')
        ];

        // Insertar producto
        $productoModel->crearProducto($data);

        return redirect()->to('/productos')->with('mensaje', 'Producto creado exitosamente.');
    }
}


