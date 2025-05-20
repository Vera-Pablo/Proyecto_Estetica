<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    // Mostrar lista de usuarios
    public function index()
    {
        $modelo = new UsuarioModel();
        $data['usuarios'] = $modelo->findAll();

        return view('back/usuarios/listarusuarios_view', $data);
    }

    // Formulario para agregar un usuario
    public function crear()
    {
        return view('back/usuarios/agregausuario_view');
    }

    // Guardar usuario nuevo en base de datos
    public function guardar()
    {
        $modelo = new UsuarioModel();

        $modelo->insert([
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email' => $this->request->getPost('email'),
            'usuario' => $this->request->getPost('usuario'),
            'pass' => $this->request->getPost('pass'), // idealmente encriptar
            'rol' => $this->request->getPost('rol'),
            'estado' => $this->request->getPost('estado'),
        ]);

        return redirect()->to('/usuarios');
    }

    // Formulario para editar usuario existente
    public function editar($id)
    {
        $modelo = new UsuarioModel();
        $data['usuario'] = $modelo->find($id);

        return view('back/usuarios/editarusuario_view', $data);
    }

    // Guardar cambios del usuario editado
    public function actualizar($id)
    {
        $modelo = new UsuarioModel();

        $modelo->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email' => $this->request->getPost('email'),
            'usuario' => $this->request->getPost('usuario'),
            'pass' => $this->request->getPost('pass'),
            'rol' => $this->request->getPost('rol'),
            'estado' => $this->request->getPost('estado'),
        ]);

        return redirect()->to('/usuarios');
    }

    // Eliminar un usuario
    public function eliminar($id)
    {
        $modelo = new UsuarioModel();
        $modelo->delete($id);

        return redirect()->to('/usuarios');
    }
}
