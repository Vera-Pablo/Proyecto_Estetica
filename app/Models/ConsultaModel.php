<?php

namespace App\Models;
use CodeIgniter\Model;

class ConsultaModel extends Model
{
    protected $table         = 'consultas';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nombre', 'email', 'asunto', 'mensaje', 'estado'];

    // Activar timestamps solo para created_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // No tienes updated_at

     protected $validationRules = [
        'nombre'  => 'required|min_length[3]|max_length[255]',
        'email'   => 'required|valid_email|max_length[255]',
        'asunto'  => 'required|min_length[3]|max_length[255]',
        'mensaje' => 'required|min_length[5]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
        ],
        'email' => [
            'required' => 'El correo es obligatorio.',
            'valid_email' => 'Debes ingresar un correo válido.',
        ],
        'asunto' => [
            'required' => 'El asunto es obligatorio.',
        ],
        'mensaje' => [
            'required' => 'El mensaje es obligatorio.',
        ],
    ];

}