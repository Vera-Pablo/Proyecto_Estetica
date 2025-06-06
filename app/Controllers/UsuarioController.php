<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{   
     public function index(){
        if (session('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        return view('usuario/panel_admin');
    }

    //Formulario de registro
    public function registro(){
        return view('usuario/registrar');
    }

    //Proceso de registro
    public function guardarRegistro()   {
        $usuarioModel = new UsuarioModel();

        // Capturamos los datos del formulario
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email'    => $this->request->getPost('email'),
            'usuario'  => $this->request->getPost('usuario'),
            'pass'     => $this->request->getPost('pass'),
        ];

        // Validaciones simples
        if (empty($data['nombre']) || empty($data['apellido']) || empty($data['email']) || empty($data['usuario']) || empty($data['pass'])) {
            return redirect()->back()->withInput()->with('error', 'Todos los campos son obligatorios.');
        }

        // Verificar si ya existe ese email
        if ($usuarioModel->where('email', $data['email'])->first()) {
            return redirect()->back()->withInput()->with('error', 'El correo ya está registrado.');
        }

        // Verificar si ya existe ese nombre de usuario
        if ($usuarioModel->where('usuario', $data['usuario'])->first()) {
            return redirect()->back()->withInput()->with('error', 'El nombre de usuario ya está en uso.');
        }

        // Encriptar la contraseña
        $data['pass'] = password_hash($data['pass'], PASSWORD_BCRYPT);
        $data['rol'] = 'cliente';
        $data['estado'] = 1;

        // Insertar en la base
        $usuarioModel->insert($data);

        return redirect()->to('/login')->with('mensaje', 'Usuario registrado correctamente.');
    }

    //Formulario de login
    public function login(){
       return view('usuario/login'); 
    }

    //Proceso del login
    public function autenticar(){
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

            return redirect()->to('/'); // Redirigir a la página de inicio 
        } else {
            return redirect()->back()->with('error', 'Email o contraseña incorrectos.');
        }
    }

    //Cierra sesión
    public function logout(){
        session()->destroy();
        return redirect()->to('/');    // Redirigir a la página de inicio ELEGIR REDIRECCION
    }
}
