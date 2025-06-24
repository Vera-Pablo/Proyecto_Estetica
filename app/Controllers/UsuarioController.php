<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{

    public function panel_admin(){
        // 1. Verifica que el usuario sea administrador
        if (session('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        
        return view('usuario/panel_admin'); 
    }
    
    public function login(){
       return view('usuario/login');
    }

    public function registro(){
        return view('usuario/registrar');
    }

    public function guardarRegistro(){
        $usuarioModel = new UsuarioModel();
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'sexo'     => $this->request->getPost('sexo'),
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

    public function autenticar(){
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        $usuario = $usuarioModel->where('email', $email)->first();

        if ($usuario && password_verify($pass, $usuario['pass'])) {
            session()->set([
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
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
    
    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

    public function editar(){
        if (!session('logueado')) {
            return redirect()->to('/login');
        }

        $usuarioModel = new UsuarioModel();
        $usuarioId = session()->get('id');

        return view('usuario/editar_perfil', );     
    }

    public function actualizar(){
        if (!session('logueado')) {
            return redirect()->to('/login');
        }

        $usuarioModel = new UsuarioModel();
        $usuarioId = session()->get('id');
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'sexo'     => $this->request->getPost('sexo'),
            'usuario'  => $this->request->getPost('usuario'),
        ];

        if (empty($data['nombre']) || empty($data['apellido']) || empty($data['usuario'])) {
            return redirect()->back()->withInput()->with('error', 'Los campos no pueden estar vacíos.');
        }

        $usuarioModel->update($usuarioId, $data);
        session()->set('nombre', $data['nombre']);

        return redirect()->to('/panel')->with('mensaje', '¡Datos actualizados con éxito!');
    }

    // --- MÉTODOS DE GESTIÓN DE ADMIN (CORREGIDOS) ---
    public function gestion_usuarios(){
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $usuarioModel = new UsuarioModel();
        

        return view('usuario/gestion_usuarios', );
             
    }

    public function editar_usuario($id){
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $usuarioModel = new UsuarioModel();
        
        if (empty($this->data['usuario'])) {
            return redirect()->to('/admin/usuarios')->with('error', 'Usuario no encontrado.');
        }

        return view('usuario/editar_usuario');
             
    }

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

    public function desactivar_usuario($id){
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $usuarioModel = new UsuarioModel();
        $usuarioModel->update($id, ['estado' => 0]);
        return redirect()->to('/admin/usuarios')->with('mensaje', 'Usuario desactivado.');
    }

    public function activar_usuario($id){
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $usuarioModel = new UsuarioModel();
        $usuarioModel->update($id, ['estado' => 1]);
        return redirect()->to('/admin/usuarios')->with('mensaje', 'Usuario activado.');
    }
}