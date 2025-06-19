<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class CategoriaController extends BaseController
{
    // Mostrar todas las categorías
    public function index()
    {
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->obtenerCategorias();

        return  view ('partials/nav_admin').
                view('categorias/index_categoria', ['categorias' => $categorias]);
    }

    // Mostrar formulario para crear categoría
    public function crear()
    {
        return  view ('partials/nav_admin').
                view('categorias/crear');
    }

    // Guardar nueva categoría
    public function guardar()
    {
        $categoriaModel = new CategoriaModel();

        $nombre = $this->request->getPost('nombre');

        if (empty($nombre)) {
            return redirect()->back()->withInput()->with('error', 'El nombre es obligatorio.');
        }

        $categoriaModel->insert([
            'nombre' => $nombre,
            'estado' => 1 
        ]);

        return redirect()->to('/categorias')->with('mensaje', 'Categoría creada correctamente.');
    }

    // Mostrar formulario para editar
    public function editar($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($id);

        if (!$categoria) {
            return redirect()->to('/categorias')->with('error', 'Categoría no encontrada.');
        }

        return  view ('partials/nav_admin').
                view('categorias/editar', ['categoria' => $categoria]);
    }

    // Actualizar categoría
    public function actualizar($id)
    {
        $categoriaModel = new CategoriaModel();
        $nombre = $this->request->getPost('nombre');

        if (empty($nombre)) {
            return redirect()->back()->withInput()->with('error', 'El nombre es obligatorio.');
        }

        $categoriaModel->update($id, ['nombre' => $nombre]);

        return redirect()->to('/categorias')->with('mensaje', 'Categoría actualizada correctamente.');
    }

    // Eliminar categoría
    public function EliminarCategoria($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->eliminarCategoria($id);

        return redirect()->to('/categorias')->with('mensaje', 'Categoría desactivada.');
    }

    // Función para activar un Categoria
    // (lo marca como activo)
// Activar categoría
    public function activar($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->update($id, ['estado' => 1]); // Cambia el estado a 1 (Activo)

        return redirect()->to('/categorias')->with('mensaje', 'Categoría activada correctamente.');
    }

        public function desactivar($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->update($id, ['estado' => 0]); // Cambia el estado a 1 (Activo)

        return redirect()->to('/categorias')->with('mensaje', 'Categoría desactivada correctamente.');
    }
}
