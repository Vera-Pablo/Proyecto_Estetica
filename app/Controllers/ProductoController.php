<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class ProductoController extends BaseController
{
    // Mostrar todos los productos
    public function index()
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
 public function detalle($id = null)
{
    if ($id === null) {
        return redirect()->to(site_url('/'))->with('error_catalogo', 'Producto no especificado.');
    }

    $productoModel = new ProductoModel();
    // Si usas el campo 'activo', asegúrate de que solo se puedan ver productos activos
    $data['producto'] = $productoModel->where('activo', 1)->find($id);
    // O si no usas 'activo' o quieres mostrarlo aunque esté inactivo (quizás para admin):
    // $data['producto'] = $productoModel->find($id);

    if (empty($data['producto'])) {
        // Si no se encontró el producto (o no está activo), puedes mostrar un mensaje
        // o redirigir. Aquí pasaremos null y la vista mostrará "Producto no encontrado".
        // Alternativamente, podrías lanzar una excepción PageNotFoundException:
        // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('partials/nav_home')
           . view('productos/detalle', $data) // Carga la vista de detalle
           . view('partials/footer');
}

    // Funciones para el administrador
    // Mostrar formulario para crear producto
    public function crear()
    {
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->obtenerCategorias();

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
            'imagen' => $this->request->getPost('imagen') // o nombre del archivo subido
        ];

        $productoModel->crearProducto($data);
        return redirect()->to('/productos')->with('mensaje', 'Producto creado.');
    }

    // Mostrar formulario para editar producto
    public function editar($id)
    {
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();

        $producto = $productoModel->obtenerProducto($id);
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

        $productoModel->actualizarProducto($id, $data);
        return redirect()->to('/productos')->with('mensaje', 'Producto actualizado.');
    }

    // Eliminar producto
    public function eliminar($id)
    {
        $productoModel = new ProductoModel();
        $productoModel->eliminarProducto($id);

        return redirect()->to('/productos')->with('mensaje', 'Producto eliminado.');
    }

}
