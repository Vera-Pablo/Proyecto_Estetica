<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{   
     public function index()
    {
        if (session('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        return view('admin/index');
    }
    //Formulario de registro
    public function registro(){
        return view('usuario/registro'); //TODAVIA NO SE HA CREADO
    }

    //Proceso de registro
    public function guardarRegistro(){
       $usuarioModel = new UsuarioModel();

       //Crear un array llamado $data
       $data = [
           'nombre' => $this->request->getPost('nombre'),
           'apellido' => $this->request->getPost('apellido'),
           'email' => $this->request->getPost('email'),
           'usuario' => $this->request->getPost('usuario'),
           'pass' => password_hash($this->request->getPost('pass'), PASSWORD_BCRYPT), // Encriptar contraseña
           'rol' => 'cliente', // Rol por defecto
           'estado' => 1, //Activo por defecto
       ];

       $usuarioModel->insert($data);
        return redirect()->to('/login')->with('mensaje', 'Usuario registrado correctamente.'); // Redirigir a la página de inicio de sesión TODAVIA NO CREADA
    }

    //Formulario de login
    public function login(){
       return view('usuario/login'); //TODAVIA NO SE HA CREADO
    }

    //Proceso del login
    public function autenticar()
    {
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');

        $usuario = $usuarioModel->getUserByEmail($email);

        if ($usuario && password_verify($pass, $usuario['pass'])) {
            // Iniciar sesión
            session()->set([
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['rol'],
                'logueado' => true
            ]);

            return redirect()->to('/'); // Redirigir a la página de inicio o dashboard ELEGIR REDIRECCION
        } else {
            return redirect()->back()->with('error', 'Email o contraseña incorrectos.');
        }
    }

    //Cierra sesión
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');    // Redirigir a la página de inicio ELEGIR REDIRECCION
    }
}
