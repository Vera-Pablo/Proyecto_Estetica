<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-tienda.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="gestion-container container-fluid my-5 px-md-5">
        <?php if (!empty($ventas)): ?>
            <h1 class="gestion-header text-center">Mi Historial de Compras</h1>
                        <?php foreach ($ventas as $venta): ?>
                            <div class="p-4 mb-4 bg-light rounded shadow-sm">
                                <div class="row">
                                    <!-- ...datos de la venta... -->
                                </div>
                                <h5>Productos de esta venta:</h5>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($venta['detalles'] as $detalle): ?>
                                            <tr>
                                                <td><?= esc($detalle['producto_nombre']) ?></td>
                                                <td><?= esc($detalle['cantidad']) ?></td>
                                                <td>$<?= number_format($detalle['precio_unitario'], 2) ?></td>
                                                <td>$<?= number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- Botón para mostrar ticket PDF -->
                                <div class="text-end mt-2">
                                    <a href="<?= base_url('ventas/ticket/' . $venta['id']) ?>" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-file-pdf me-2"></i>Mostrar Ticket
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center">No tienes compras registradas.</div>
        <?php endif; ?>
    <div class="text-center mt-4">
        <a href="<?= site_url('/panel') ?>" class="btn btn-secondary-custom">
            <i class="fas fa-arrow-left me-2"></i>Volver a mi perfil
        </a>
    </div>
</div>
</body>
</html> 