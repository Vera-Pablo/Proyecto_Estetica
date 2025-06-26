<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\VentaModel;
use App\Models\VentaDetalleModel;
use App\Models\ProductoModel;
use App\Models\CarritoModel;

class VentaController extends BaseController
{
   public function index(){
    $ventaModel = new VentaModel();
    $detalleModel = new VentaDetalleModel();
    $usuarioModel = new UsuarioModel();
    $usuarioId = session()->get('id');
    $usuarioRol = session()->get('rol');

    if ($usuarioRol === 'admin') {
        if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $data['ventas'] = $ventaModel->obtenerTodasLasVentasConUsuario();
        $data['clientes'] = $usuarioModel->findAll();

        // Agregar detalles de productos a cada venta
        foreach ($data['ventas'] as &$venta) {
            $venta['detalles'] = $detalleModel
                ->select('detalle_venta.*, productos.nombre as producto_nombre, productos.precio')
                ->join('productos', 'productos.id = detalle_venta.producto_id')
                ->where('venta_id', $venta['id'])
                ->findAll();
        }

        return view('ventas/gestion_ventas', $data);
    } else {

            $ventas = $ventaModel->obtenerVentasPorUsuario($usuarioId);

            foreach ($ventas as &$venta) {
                $venta['detalles'] = $detalleModel
                    ->select('detalle_venta.*, productos.nombre as producto_nombre')
                    ->join('productos', 'productos.id = detalle_venta.producto_id')
                    ->where('venta_id', $venta['id'])
                    ->findAll();
            }

            return view('ventas/detalle_ventas', ['ventas' => $ventas]);
        }
    }

    public function checkout(){
        $carritoModel = new CarritoModel();
        $productoModel = new ProductoModel();
        $usuarioId = session()->get('id');
        $items = $carritoModel->where('usuario_id', $usuarioId)->findAll();

        $total = 0;
        foreach ($items as &$item) {
            $item['producto'] = $productoModel->find($item['producto_id']);
            if ($item['producto']) {
                $total += $item['producto']['precio'] * $item['cantidad'];
            }
        }

        return view('ventas/checkout', [
            'items' => $items,
            'total' => $total
        ]);
    }
    
    // Procesa la venta y actualiza el stock de los productos
    public function procesar_venta(){
        $carritoModel = new \App\Models\CarritoModel();
        $productoModel = new \App\Models\ProductoModel();
        $ventaModel = new \App\Models\VentaModel();
        $detalleModel = new \App\Models\VentaDetalleModel();
        $usuarioId = session()->get('id');
        $items = $carritoModel->where('usuario_id', $usuarioId)->findAll();

        if (empty($items)) {
            return redirect()->to('/carrito')->with('mensaje', 'Tu carrito está vacío.');
        }

        // Calcular total
        $total = 0;
        foreach ($items as $item) {
            $producto = $productoModel->find($item['producto_id']);
            if ($producto) {
                $total += $producto['precio'] * $item['cantidad'];
            }
        }

        // Guardar la venta
        $ventaId = $ventaModel->insert([
            'usuario_id' => $usuarioId,
            'fecha' => date('Y-m-d H:i:s'),
            'total' => $total,
            'estado' => 'pagado'
        ]);

        // Guardar los detalles y descontar stock
        foreach ($items as $item) {
            $producto = $productoModel->find($item['producto_id']);
            if ($producto) {
                $detalleModel->insert([
                    'venta_id' => $ventaId,
                    'producto_id' => $producto['id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto['precio']
                ]);
                // Descontar stock
                $nuevoStock = $producto['stock'] - $item['cantidad'];
                if ($nuevoStock < 0) $nuevoStock = 0;
                $productoModel->update($producto['id'], ['stock' => $nuevoStock]);

                if($nuevoStock == 0){
                    $productoModel->update($producto['id'], ['estado' => 0]);
                }
            }
        }

        // Vaciar el carrito
        $carritoModel->where('usuario_id', $usuarioId)->delete();

        return redirect()->to('/ventas')->with('mensaje', '¡Compra realizada con éxito!');
    }

   public function gestion_ventas(){
        // Solo permite acceso a admins
        if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }
        $ventaModel = new \App\Models\VentaModel();
        $detalleModel = new \App\Models\VentaDetalleModel();
        $usuarioModel = new \App\Models\UsuarioModel();
        $filtros = []; 
        $ventas = $ventaModel->obtenerTodasLasVentasConUsuario($filtros);
        $clientes = $usuarioModel->findAll();

        // Agregar detalles de productos a cada venta
        foreach ($ventas as &$venta) {
            $venta['detalles'] = $detalleModel
                ->select('detalle_venta.*, productos.nombre as producto_nombre, productos.precio')
                ->join('productos', 'productos.id = detalle_venta.producto_id')
                ->where('venta_id', $venta['id'])
                ->findAll();
        }

        return view('ventas/gestion_ventas', [
            'ventas' => $ventas,
            'clientes' => $clientes
        ]);
    }

   public function ver($id){
    // Solo permite acceso a admins
    if (!session()->get('logueado') || session()->get('rol') !== 'admin') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado.');
    }
    $ventaModel = new \App\Models\VentaModel();
    $detalleModel = new \App\Models\VentaDetalleModel();

    $venta = $ventaModel->find($id);
    $detalles = $detalleModel
        ->select('detalle_venta.*, productos.nombre as producto_nombre')
        ->join('productos', 'productos.id = detalle_venta.producto_id')
        ->where('venta_id', $id)
        ->findAll();

    return view('ventas/ver_venta', [
        'venta' => $venta,
        'detalles' => $detalles
     ]);
    }
}