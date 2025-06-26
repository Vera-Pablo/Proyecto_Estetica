<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    
    public function panel(){
        // 1. Verifica que el usuario sea administrador
        if (session('rol') !== 'admin') {
            return view('usuario/panel');
        }
        return view('usuario/panel_admin'); 
    }
    
    // Método para mostrar el login
    public function login(){
       return view('usuario/login');
    }

    // Método para mostrar el formulario de registro
    public function registro(){
        return view('usuario/registrar');
    }

    // Método para guardar el registro de un nuevo usuario
    public function guardarRegistro(){
        $usuarioModel = new UsuarioModel();
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email'    => $this->request->getPost('email'),
            'usuario'  => $this->request->getPost('usuario'),
            'pass'     => $this->request->getPost('pass'),
        ];

        if (empty($data['nombre']) || empty($data['apellido']) || empty($data['email']) || empty($data['usuario']) || empty($data['pass'])) {
            return redirect()->back()->withInput()->with('error', 'Todos los campos son obligatorios.');
        }

        if ($usuarioModel->where('email', $data['email'])->first()) {
            return redirect()->back()->withInput()->with('error', 'El correo ya está registrado.');
        }

        if ($usuarioModel->where('usuario', $data['usuario'])->first()) {
            return redirect()->back()->withInput()->with('error', 'El nombre de usuario ya está en uso.');
        }

        $data['pass'] = password_hash($data['pass'], PASSWORD_BCRYPT);
        $data['rol'] = 'cliente';
        $data['estado'] = 1;
        $usuarioModel->insert($data);

        return redirect()->to('/login')->with('mensaje', 'Usuario registrado correctamente.');
    }

    // Autenticar usuario verifica las credenciales del usuario y establece la sesión
    public function autenticar(){
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        $usuario = $usuarioModel->where('email', $email)->first();

        if ($usuario && password_verify($pass, $usuario['pass'])) {
            session()->set([
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'usuario' => $usuario['usuario'],
                'email' => $usuario['email'],
                'rol' => $usuario['rol'],
                'logueado' => true
            ]);

            // Si es admin, lo mandamos a su panel, si no, a la página principal
            if ($usuario['rol'] === 'admin') {
                return redirect()->to('/panel_admin');
            }
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Email o contraseña incorrectos.');
        }
    }
    
    // Cerrar sesión
    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

    //Editar perfil del usuario
    public function editarPerfil(){
        if (!session('logueado')) {
            return redirect()->to('/login');
        }

        $usuarioModel = new UsuarioModel();
        $usuarioId = session()->get('id');

        return view('usuario/editar_perfil', );     
    }
    
    // Método editar usuario específico
    public function editar_usuario($id){
        // Solo permite acceso a admins
        if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        return view('usuario/editar_usuario', ['usuario' => $usuario]);  
    }

    // Muestra el formulario para editar perfil el usuario
    public function editar(){
        $usuarioModel = new UsuarioModel();
        $usuarioId = session()->get('id');
        $usuario = $usuarioModel->find($usuarioId);

        return view('usuario/editar_perfil', ['usuario' => $usuario]);
    }

    // Método para actualizar los datos del usuario
    public function actualizar(){
        $usuarioModel = new UsuarioModel();
        $usuarioId = session()->get('id');
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'usuario'  => $this->request->getPost('usuario'),
        ];
        
        if (empty($data['nombre']) || empty($data['apellido']) || empty($data['usuario'])) {
            return redirect()->back()->withInput()->with('mensaje', 'Los campos no pueden estar vacíos.');
        }

        $usuarioModel->update($usuarioId, $data);
        session()->set('nombre', $data['nombre']);

        return redirect()->to('/ panel')->with('mensaje', '¡Datos actualizados con éxito!');
    }

    // Método para mostrar la gestión de usuarios
    public function gestion_usuarios(){
        // Solo permite acceso a admins
        if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $usuarioModel = new \App\Models\UsuarioModel();
        $usuarios = $usuarioModel->findAll();

        return view('Usuario/gestion_usuarios', ['usuarios' => $usuarios]);
    }

    // Método para actualizar un usuario específico
    public function actualizar_usuario($id){
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $usuarioModel = new UsuarioModel();
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email'    => $this->request->getPost('email'),
            'rol'      => $this->request->getPost('rol'),
        ];

        $usuarioModel->update($id, $data);
        return redirect()->to('/admin/usuarios')->with('mensaje', 'Usuario actualizado correctamente.');
    }

    // Método para desactivar un usuario específico
    public function desactivar_usuario($id){
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $usuarioModel = new UsuarioModel();
        $usuarioModel->update($id, ['estado' => 0]);
        return redirect()->to('/admin/usuarios')->with('mensaje', 'Usuario desactivado.');
    }

    // Método para activar un usuario específico
    public function activar_usuario($id){
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $usuarioModel = new UsuarioModel();
        $usuarioModel->update($id, ['estado' => 1]);
        return redirect()->to('/admin/usuarios')->with('mensaje', 'Usuario activado.');
    }
}