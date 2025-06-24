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
}
