<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table = 'usuarios';
    
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'apellido',
        'email',
        'usuario',
        'pass',
        'rol',
        'estado',
    ];     
}
