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
    
    //Busca un usuario por su email.
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    //Busca un usuario por su id.
    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }

    //Crea un usuario nuevo.
    public function createUser($data)
    {
        return $this->insert($data);
    }

    //Actualiza los datos de un usuario existente.
    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    //Elimina un usuario.
    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    public function obtenerTodosLosUsuarios()
    {
    // Usamos 'orderBy' para que la lista aparezca ordenada por ID
    return $this->orderBy('id', 'ASC')->findAll();
    }
}
