<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class ProductoController extends BaseController
{
    // Muestra el lista de productos con sus respectivas categorías
    public function index(){
        if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
    return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $productoModel = new ProductoModel();
        $productos = $productoModel
            ->select('productos.*, categoria.nombre as categoria')
            ->join('categoria', 'categoria.id = productos.categoria_id', 'left')
            ->orderBy('productos.id', 'DESC')
            ->findAll();

        return view('productos/index_producto', ['productos' => $productos]);
        }


    // Muestra el formulario para crear un nuevo producto
    public function crear(){
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        return view('productos/crear', ['categorias' => $categorias]);
    }

    // Guarda un nuevo producto en la base de datos
    public function guardar(){
        $productoModel = new ProductoModel();
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'estado' => 1, // Por defecto, el producto está activo
        ];

        // Guardar el producto
        if ($productoModel->insert($data)) {
            return redirect()->to('/index_producto')->with('success', 'Producto creado exitosamente.');
        } else {
            return redirect()->back()->withInput()->with('errors', $productoModel->errors());
        }
    }

    // editar un producto existente
    public function editar($id){
        if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id);

        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        return view('productos/editar', ['producto' => $producto, 'categorias' => $categorias]);
    }

    // Actualiza un producto existente
    public function actualizar($id){
        $productoModel = new ProductoModel();
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
            'categoria_id' => $this->request->getPost('categoria_id'),
        ];

        // Actualizar el producto
        if ($productoModel->update($id, $data)) {
            return redirect()->to('/index_producto')->with('mensaje', 'Producto actualizado exitosamente.');
        } else {
            return redirect()->back()->withInput()->with('errors', $productoModel->errors());
        }
    }

    // Desactiva un producto
    public function desactivar($id){
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id);

        if ($producto) {
            $producto['estado'] = 0; // Cambia el estado a inactivo
            $productoModel->update($id, $producto);
            return redirect()->to('/index_producto')->with('mensaje', 'Producto desactivado exitosamente.');
        } else {
            return redirect()->to('/index_producto')->with('error', 'Producto no encontrado.');
        }
    }

    // Activa un producto
    public function activar($id){
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id);

        if ($producto) {
            $producto['estado'] = 1; // Cambia el estado a activo
            $productoModel->update($id, $producto);
            return redirect()->to('/index_producto')->with('mensaje', 'Producto activado exitosamente.');
        } else {
            return redirect()->to('/index_producto')->with('error', 'Producto no encontrado.');
        }
    }

    // Muestra el catálogo de productos para los usuarios/administradores
    public function catalogo(){
        $productoModel = new \App\Models\ProductoModel();
        $busqueda = $this->request->getGet('busqueda');

        $productoModel->where('estado', 1); // Solo productos activos

        if ($busqueda) {
            $productoModel->like('nombre', $busqueda);
        }

        $productos = $productoModel->findAll();

        return view('productos/catalogo', ['productos' => $productos]);
    }

    public function detalle($id){
        $productoModel = new ProductoModel();
        $producto = $productoModel->obtenerProductoId($id);

        if (!$producto){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado");
        }

        
        return view('productos/detalle_producto', ['producto' => $producto]);
    }

}
