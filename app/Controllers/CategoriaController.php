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

        return view('categorias/index', ['categorias' => $categorias]);
    }

    // Mostrar formulario para crear categoría
    public function crear()
    {
        return view('categorias/crear');
    }

    // Guardar nueva categoría
    public function guardar()
    {
        $categoriaModel = new CategoriaModel();

        $data = [
            'nombre' => $this->request->getPost('nombre')
        ];

        $categoriaModel->insert($data);
        return redirect()->to('/categorias')->with('mensaje', 'Categoría agregada.');
    }

    // Mostrar formulario para editar
    public function editar($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($id);

        return view('categorias/editar', ['categoria' => $categoria]);
    }

    // Actualizar categoría
    public function actualizar($id)
    {
        $categoriaModel = new CategoriaModel();

        $data = [
            'nombre' => $this->request->getPost('nombre')
        ];

        $categoriaModel->update($id, $data);
        return redirect()->to('/categorias')->with('mensaje', 'Categoría actualizada.');
    }

    // Eliminar categoría
    public function eliminar($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);

        return redirect()->to('/categorias')->with('mensaje', 'Categoría eliminada.');
    }
}
