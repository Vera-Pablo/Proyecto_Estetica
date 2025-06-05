<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
// Asumiendo que tienes un CarritoModel para obtener los items a comprar
// use App\Models\CarritoModel; 
use App\Models\ProductoModel;


class VentaController extends BaseController
{
    public function __construct()
    {
        helper(['session', 'url', 'form']); // Agregado 'form' si se usa en vistas
    }

    /**
     * Muestra el historial de ventas del usuario logueado.
     */
    public function index()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver tu historial de compras.');
        }

        $ventaModel = new VentaModel();
        $usuarioId = session()->get('id');
        $data['ventas'] = $ventaModel->obtenerVentasPorUsuario($usuarioId);

        // TODO: Crear y retornar la vista adecuada, ej:
        // return view('path/to/your/historial_ventas_view', $data);
        echo "<h1>Mi Historial de Compras</h1>";
        if (!empty($data['ventas'])) {
            echo "<ul>";
            foreach ($data['ventas'] as $venta) {
                echo "<li>ID Venta: {$venta->id} - Fecha: {$venta->fecha} - Total: \${$venta->total} 
                      <a href='".site_url('/ventas/ver/'.$venta->id)."'>Ver Detalles</a>
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No has realizado ninguna compra.</p>";
        }
    }

    /**
     * Muestra los detalles de una venta específica.
     * @param int $ventaId ID de la venta.
     */
    public function ver($ventaId = null)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver los detalles de la compra.');
        }

        if ($ventaId === null) {
            return redirect()->to('/ventas')->with('error', 'Venta no especificada.');
        }

        $ventaModel = new VentaModel();
        $detalleVentaModel = new DetalleVentaModel();
        $usuarioId = session()->get('id');

        $venta = $ventaModel->obtenerVentaPorId($ventaId);

        // Verificar que la venta pertenezca al usuario logueado
        if (!$venta || $venta->usuario_id != $usuarioId) {
            return redirect()->to('/ventas')->with('error', 'No tienes permiso para ver esta venta o la venta no existe.');
        }

        $data['venta'] = $venta;
        $data['detalles'] = $detalleVentaModel->obtenerDetallesPorVentaId($ventaId);

        // TODO: Crear y retornar la vista adecuada, ej:
        // return view('path/to/your/detalle_venta_view', $data);
         echo "<h1>Detalle de Compra ID: {$venta->id}</h1>";
        echo "<p>Fecha: {$venta->fecha}</p>";
        echo "<p>Total: \${$venta->total}</p>";
        echo "<h3>Productos:</h3>";
        if (!empty($data['detalles'])) {
            echo "<ul>";
            foreach ($data['detalles'] as $detalle) {
                echo "<li>{$detalle->producto_nombre} - Cantidad: {$detalle->cantidad} - Precio Unit.: \${$detalle->precio_unitario}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No se encontraron detalles para esta compra.</p>";
        }
    }

    /**
     * Procesa la creación de una venta (Checkout).
     * Este es un ejemplo simplificado. Un checkout real es más complejo.
     */
    public function procesarCheckout()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para realizar una compra.');
        }

        $usuarioId = session()->get('id');
        
        // Aquí obtendrías los ítems del carrito del usuario.
        // Por simplicidad, vamos a simular algunos ítems.
        // En un caso real, usarías tu CarritoModel.
        // $carritoModel = new \App\Models\CarritoModel(); // Si lo tienes
        // $itemsCarrito = $carritoModel->obtenerItems($usuarioId, null); // o el método que tengas

        // --- INICIO SIMULACIÓN DE CARRITO ---
        $productoModel = new ProductoModel();
        $prod1 = $productoModel->find(1); // Asegúrate que el producto con ID 1 exista
        $prod2 = $productoModel->find(2); // Asegúrate que el producto con ID 2 exista

        $itemsSimulados = [];
        if ($prod1) {
            $itemsSimulados[] = ['producto_id' => $prod1->id, 'cantidad' => 2, 'precio_unitario' => $prod1->precio];
        }
        if ($prod2) {
             $itemsSimulados[] = ['producto_id' => $prod2->id, 'cantidad' => 1, 'precio_unitario' => $prod2->precio];
        }
       
        if (empty($itemsSimulados)) {
             return redirect()->to('/carrito')->with('error', 'Tu carrito está vacío o los productos no existen.'); // Redirigir a la vista del carrito
        }
        // --- FIN SIMULACIÓN DE CARRITO ---

        $totalVenta = 0;
        $itemsParaDetalle = [];

        foreach ($itemsSimulados as $item) {
            // Validar stock aquí si es necesario, antes de crear la venta.
            // $producto = $productoModel->find($item['producto_id']);
            // if ($producto->stock < $item['cantidad']) { ... }
            
            $subtotal = $item['cantidad'] * $item['precio_unitario'];
            $totalVenta += $subtotal;
            $itemsParaDetalle[] = [
                'producto_id'     => $item['producto_id'],
                'cantidad'        => $item['cantidad'],
                'precio_unitario' => $item['precio_unitario']
            ];
        }

        if (empty($itemsParaDetalle)) {
            return redirect()->back()->with('error', 'No hay ítems para procesar la compra.');
        }

        $ventaModel = new VentaModel();
        $datosVenta = [
            'usuario_id' => $usuarioId,
            'total'      => $totalVenta,
            'fecha'      => date('Y-m-d H:i:s') // Fecha y hora actual
        ];

        $idVenta = $ventaModel->crearVentaConDetalles($datosVenta, $itemsParaDetalle);

        if ($idVenta) {
            // Aquí podrías vaciar el carrito del usuario
            // $carritoModel->vaciarCarrito($usuarioId, null);
            
            // Enviar email de confirmación, etc.
            return redirect()->to("/ventas/ver/{$idVenta}")->with('mensaje', '¡Compra realizada con éxito!');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al procesar tu compra. Inténtalo de nuevo.');
        }
    }
}