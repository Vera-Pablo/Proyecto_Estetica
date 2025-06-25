<?php

namespace App\Controllers;

use App\Models\ConsultaModel;
use CodeIgniter\Controller;

class ConsultaController extends Controller
{
    public function index()
    {
        // Muestra el formulario de consulta
        $data['validation'] = \Config\Services::validation(); // Para mostrar errores de validación
        return view('consultas/crear_consulta', $data);
    }

        public function guardar()
        {
            $model = new \App\Models\ConsultaModel();

            $validation = \Config\Services::validation();
            $validation->setRules($model->validationRules, $model->validationMessages);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }

            $data = [
                'nombre'  => $this->request->getPost('nombre'),
                'email'   => $this->request->getPost('email'),
                'asunto'  => $this->request->getPost('asunto'),
                'mensaje' => $this->request->getPost('mensaje'),
                'estado'  => 'Abierto'
            ];

            $model->save($data);

            return redirect()->to('/')->with('success', '¡Tu consulta fue enviada con éxito!');
        }

    // --- Funciones para el panel de administrador ---

    public function verConsultasAdmin()
    {
        $model = new \App\Models\ConsultaModel();
        $data['consultas'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('consultas/admin_consultas', $data);
    }

    // Opcional: Función para cambiar el estado de una consulta (por ejemplo, a "Cerrado" o "En proceso")
    public function cambiarEstado($id)
    {
        $model = new ConsultaModel();
        $consulta = $model->find($id);

        if ($consulta) {
            $nuevoEstado = ($consulta['estado'] == 'Abierto') ? 'Cerrado' : 'Abierto'; // Ejemplo simple
            $model->update($id, ['estado' => $nuevoEstado]);
            session()->setFlashdata('success', 'Estado de la consulta actualizado.');
        } else {
            session()->setFlashdata('error', 'Consulta no encontrada.');
        }
        return redirect()->to('/admin/consultas'); // Redirige a la vista de administración
    }
}