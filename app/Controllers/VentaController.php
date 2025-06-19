<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\VentaModel;
use App\Models\VentaDetalleModel;
use App\Models\ProductoModel;
use App\Models\CarritoModel;

class VentaController extends BaseController
{
    private $data;

    public function __construct()
    {
        helper(['session', 'url', 'form']);
        if (session()->get('logueado') && session()->get('rol') === 'admin') {
            $this->data['nav_view'] = 'partials/nav_admin';
        } else {
            $this->data['nav_view'] = 'partials/nav_home';
        }
    }

    public function checkout()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para comprar.');
        }

        $carritoModel = new CarritoModel();
        $productoModel = new ProductoModel();
        $usuarioId = session('id');
        $items = $carritoModel->obtenerCarritoPorUsuario($usuarioId);
        $total = 0;

        if (empty($items)) {
            return redirect()->to('/carrito')->with('error', 'Tu carrito está vacío.');
        }

        foreach ($items as &$item) {
            $item['producto'] = $productoModel->find($item['producto_id']);
            $total += $item['producto']['precio'] * $item['cantidad'];
        }

        $this->data['items'] = $items;
        $this->data['total'] = $total;

        return view($this->data['nav_view'])
             . view('ventas/checkout', $this->data)
             . view('partials/footer');
    }

    public function procesar_venta()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $ventaModel = new VentaModel();
            $ventaDetalleModel = new VentaDetalleModel();
            $carritoModel = new CarritoModel();
            $productoModel = new ProductoModel();
            $usuarioId = session('id');
            $items = $carritoModel->obtenerCarritoPorUsuario($usuarioId);
            $total = 0;

            foreach ($items as $item) {
                $producto = $productoModel->find($item['producto_id']);
                $total += $producto['precio'] * $item['cantidad'];
            }

            $ventaId = $ventaModel->insert([
                'usuario_id'  => $usuarioId,
                'total'       => $total,
                'metodo_pago' => $this->request->getPost('metodo_pago'),
            ]);

            foreach ($items as $item) {
                $producto = $productoModel->find($item['producto_id']);
                $ventaDetalleModel->insert([
                    'venta_id'        => $ventaId,
                    'producto_id'     => $item['producto_id'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $producto['precio'],
                ]);
                $productoModel->actualizarStock($item['producto_id'], $item['cantidad']);
            }
            
            $carritoModel->limpiarCarrito($usuarioId);
            $db->transCommit();

            return redirect()->to('/gracias')->with('mensaje', '¡Gracias por tu compra!');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to('/checkout')->with('error', 'Hubo un error al procesar tu compra: ' . $e->getMessage());
        }
    }

    public function index()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver tu historial de compras.');
        }

        $ventaModel = new VentaModel();
        $usuarioId = session()->get('id');
        $this->data['ventas'] = $ventaModel->obtenerVentasPorUsuario($usuarioId);

        return view($this->data['nav_view'])
             . view('ventas/index', $this->data)
             . view('partials/footer');
    }

    public function ver($ventaId = null)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver los detalles de la compra.');
        }

        $ventaModel = new VentaModel();
        $ventaDetalleModel = new VentaDetalleModel();
        $productoModel = new ProductoModel();
        $usuarioId = session()->get('id');
        $venta = $ventaModel->find($ventaId);

        if (!$venta || ($venta['usuario_id'] != $usuarioId && session()->get('rol') !== 'admin')) {
            return redirect()->to('/ventas')->with('error', 'No tienes permiso para ver esta venta o la venta no existe.');
        }

        $detalles = $ventaDetalleModel->where('venta_id', $ventaId)->findAll();
        foreach ($detalles as &$detalle) {
            $producto = $productoModel->find($detalle['producto_id']);
            $detalle['producto_nombre'] = $producto ? $producto['nombre'] : 'Producto no encontrado';
        }

        $this->data['venta'] = $venta;
        $this->data['detalles'] = $detalles;
        
        return view($this->data['nav_view'])
             . view('ventas/detalle', $this->data)
             . view('partials/footer');
    }
    
public function gestion_ventas()
    {
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $ventaModel = new VentaModel();
        $usuarioModel = new \App\Models\UsuarioModel(); // Para obtener la lista de clientes

        // Recoger los filtros del formulario (si existen)
        $filtros = [
            'fecha_inicio' => $this->request->getGet('fecha_inicio'),
            'fecha_fin'    => $this->request->getGet('fecha_fin'),
            'cliente_id'   => $this->request->getGet('cliente_id')
        ];
        
        // Obtener los datos aplicando los filtros
        $ventas = $ventaModel->obtenerTodasLasVentasConUsuario($filtros);

        // Calcular totales para el resumen
        $totalVendido = array_sum(array_column($ventas, 'total'));
        $cantidadVentas = count($ventas);

        // Pasamos todos los datos necesarios a la vista
        $this->data['ventas'] = $ventas;
        $this->data['clientes'] = $usuarioModel->obtenerClientes(); // Lista para el dropdown
        $this->data['totalVendido'] = $totalVendido;
        $this->data['cantidadVentas'] = $cantidadVentas;
        $this->data['filtros_aplicados'] = $filtros; // Para mantener los valores en el form

        return view($this->data['nav_view'])
             . view('ventas/gestion_ventas', $this->data);
    }

    public function actualizar_estado($ventaId)
    {
        // 1. Verificar que sea un admin
        if (session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        // 2. Obtener el nuevo estado desde el formulario
        $nuevoEstado = $this->request->getPost('estado');

        // 3. Validar que el estado no esté vacío
        if (empty($nuevoEstado)) {
            return redirect()->back()->with('error', 'Debe seleccionar un estado.');
        }

        // 4. Actualizar la base de datos
        $ventaModel = new \App\Models\VentaModel();
        $ventaModel->update($ventaId, ['estado' => $nuevoEstado]);

        // 5. Redirigir de vuelta con un mensaje de éxito
        return redirect()->to('/admin/ventas')->with('mensaje', 'El estado de la venta ha sido actualizado.');
    }
}