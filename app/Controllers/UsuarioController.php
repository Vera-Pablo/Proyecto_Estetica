<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{   

    //Formulario de registro
    public function registro(){
        return view('usuario/registrar');
    }

    //Formulario de login
    public function login(){
       return view('usuario/login'); 
    }

    // registro Usuario
    public function guardarRegistro(){
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->guardarRegistro();
    }

    // Autentificación y login
    public function autenticar(){
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->autenticar();
    }
    
     // Cierra sesión
    public function logout(){
        $usuarioModel = new UsuarioModel();
        return $usuarioModel->logout();
    }

    // Desactiva un usuario (admin)
    public function desactivar($id){
        $usuarioModel = new UsuarioModel();
        $usuarioModel->desactivarUser($id);
        return redirect()->to('/panel_admin')->with('mensaje', 'Usuario desactivado correctamente.');
    }

    // Actualiza datos de usuario (puedes adaptar según tu formulario)
    public function actualizarDatos($id){
        $usuarioModel = new UsuarioModel();
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email'    => $this->request->getPost('email'),
            // ...otros campos según tu formulario
        ];
        $usuarioModel->actulizarDatos($id, $data);
        return redirect()->to('/usuarios')->with('mensaje', 'Datos actualizados correctamente.');
    }
}
