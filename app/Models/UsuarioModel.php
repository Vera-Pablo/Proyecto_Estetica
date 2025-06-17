<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // Especifica la tabla de la base de datos con la que se trabajará.
    protected $table = 'usuarios';
    
    // Define el campo que sirve como clave primaria de la tabla.
    protected $primaryKey = 'id';

    // Lista de campos que se permiten modificar (insertar y actualizar).
    // Estos deben coincidir exactamente con los nombres de campos en tu tabla.
    protected $allowedFields = [
        'nombre',
        'apellido',
        'email',
        'usuario',
        'pass',
        'rol',
        'estado',
        'sexo'
    ];

    //Crea un usuario nuevo.
    public function createUser($data){
        return $this->insert($data);
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

    //Elimina un usuario.
    public function desactivarUser($id){
        return $this->update($id, ['estado' => 0]);
    }

    //Actualiza los datos de un usuario existente.
    public function actulizarDatos($id, $data){
        return $this->update($id, $data);
    }

    //Busca un usuario por su email.
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    //Busca un usuario por su id.
    public function getUserById($id){
        return $this->where('id', $id)->first();
    }

        public function obtenerTodosLosUsuarios()
    {
        // El método findAll() es una función incorporada de CodeIgniter
        // que obtiene todos los registros de la tabla 'usuarios'.
        return $this->findAll();
    }
       
}
