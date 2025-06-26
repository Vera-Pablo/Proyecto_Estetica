<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class CategoriaController extends BaseController
{
    // Mostrar todas las categorías
    public function index(){
        // Solo permite acceso a admins
        if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->orderBy('nombre', 'ASC')->findAll();

        return view('categorias/index_categoria', ['categorias' => $categorias]);
    }

    // Mostrar formulario para crear categoría
    public function crear(){
        return view('categorias/crear');
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
    public function editar($id){
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($id);

        if (!$categoria) {
            return redirect()->to('/categorias')->with('error', 'Categoría no encontrada.');
        }

        return  view('categorias/editar', ['categoria' => $categoria]);
    }

    // Actualizar categoría
    public function actualizar($id){
        $categoriaModel = new CategoriaModel();
        $nombre = $this->request->getPost('nombre');

        if (empty($nombre)) {
            return redirect()->back()->withInput()->with('error', 'El nombre es obligatorio.');
        }

        $categoriaModel->update($id, ['nombre' => $nombre]);

        return redirect()->to('/categorias')->with('mensaje', 'Categoría actualizada correctamente.');
    }

    // Activar categoría
    public function activar($id){
        $categoriaModel = new CategoriaModel();
        $categoriaModel->update($id, ['estado' => 1]); 

        return redirect()->to('/categorias')->with('mensaje', 'Categoría activada correctamente.');
    }

    // Desactivar categoría
    public function desactivar($id){
        $categoriaModel = new CategoriaModel();
        $productoModel = new \App\Models\ProductoModel();

        $productoAsociado = $productoModel->where('categoria_id', $id)->first();

        if ($productoAsociado) {
            return redirect()->to('/categorias')->with('mensaje', 'No se puede desactivar la categoría porque tiene productos asociados.');
        }

        $categoriaModel->update($id, ['estado' => 0]);
        return redirect()->to('/categorias')->with('mensaje', 'Categoría desactivada correctamente.');
    }
}
