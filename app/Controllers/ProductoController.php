<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class ProductoController extends BaseController
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->obtenerProductos();

        return   view('partials/nav_admin')
                .view('productos/index_producto', ['productos' => $productos]);
    }

    // Mostrar todos los productos
    public function catalogo()
    {
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();

        $productos = $productoModel->obtenerProductos();
        $categorias = $categoriaModel->obtenerCategorias();

        return view('productos/catalogo', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

    // Buscar productos por texto (nombre parcial)
    public function buscar()
    {
        $texto = $this->request->getGet('q'); // del input name="q"
        $productoModel = new ProductoModel();
        $resultados = $productoModel->buscarPorNombre($texto);

        return view('productos/catalogo', ['productos' => $resultados]);
    }

    // Filtrar productos por categoría
    public function filtrarPorCategoria($categoria_id)
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->filtrarPorCategoria($categoria_id);

        return view('productos/catalogo', ['productos' => $productos]);
    }

    // Ver detalle de un producto
    public function detalle($id)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->obtenerProducto($id);

        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado");
        }

        return view('productos/detalle', ['producto' => $producto]);
    }

    // * * * FUNCIONES PARA EL ADMINISTRADOR * * *
    // Crear producto
    public function crearProducto(){
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        return view('productos/crear', ['categorias' => $categorias]);
    }

    // Guardar nuevo producto
    public function guardar()
    {
        $productoModel = new ProductoModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'imagen' => $nombreImagen = $this->request->getPost('nombre_imagen')
        ];

        $productoModel->crearProducto($data);
        return redirect()->to('/productos')->with('mensaje', 'Producto creado.');
    }

    // Mostrar formulario para editar producto
    public function editar($id)
    {
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();

        $producto = $productoModel->obtenerProductoId($id);
        $categorias = $categoriaModel->obtenerCategorias();

        return view('productos/editar', [
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

    // Actualizar producto
    public function actualizar($id)
    {
        $productoModel = new ProductoModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'imagen' => $this->request->getPost('imagen')
        ];

        // Ver si hay nueva imagen
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move('assets/img/', $nombreImagen);
            $data['imagen'] = $nombreImagen;
        }

        $productoModel->actualizarProducto($id, $data);
        return redirect()->to('/productos')->with('mensaje', 'Producto actualizado.');
    }

    // Eliminar producto
    public function eliminarProducto($id){
        $productoModel = new ProductoModel(); // 1. Instanciar el modelo
        $productoModel->eliminarProducto($id); // 2. Llamar al método

        return redirect()->to('/productos')->with('mensaje', 'Producto desactivado correctamente.');
    }

    // Función para activar un producto
    // (lo marca como activo)
    public function activar($id)
    {
        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($id);

        if (!$producto) {
            return redirect()->to('/productos')->with('error', 'Producto no encontrado.');
        }

        $productoModel->update($id, ['estado' => 1]); // Cambia el estado a 1 (Activo)

        return redirect()->to('/productos')->with('mensaje', 'Producto activado correctamente.');
    }
        // Función para desactivar un producto
    // (en lugar de eliminarlo, lo marca como inactivo)
    public function desactivar($id)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id);

        if (!$producto) {
            return redirect()->to('/productos')->with('error', 'Producto no encontrado.');
        }

        $productoModel->update($id, ['estado' => 0]);

        return redirect()->to('/productos')->with('mensaje', 'Producto desactivado correctamente.');
    }

}
