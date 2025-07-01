<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Historial de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/estilos-ventasHistorial.css') ?>" rel="stylesheet"></head>
<body>
    <div class="historial-container my-5">
        <h1 class="historial-header text-center mb-5">Mi Historial  de Compras</h1>
        <?php if (!empty($ventas)): ?>
            <?php foreach ($ventas as $venta): ?>
                <div class="venta-card mb-4">
                    <div class="venta-header">
                        <span class="order-id">Orden #<?= esc($venta['id']) ?></span>
                        <span class="order-date">Fecha: <?= date('d/m/Y', strtotime(esc($venta['fecha']))) ?></span>
                    </div>
                    <div class="venta-estado mb-2">
                        <?php
                            $estado = strtolower($venta['estado']);
                            $claseBadge = 'bg-secondary';
                            if ($estado == 'pagado') $claseBadge = 'bg-success';
                            if ($estado == 'pendiente') $claseBadge = 'bg-warning text-dark';
                            if ($estado == 'cancelado') $claseBadge = 'bg-danger';
                        ?>
                        <span class="badge <?= $claseBadge ?>"><?= esc(ucfirst($venta['estado'])) ?></span>
                    </div>
                    <div class="venta-total mb-3">
                        Total de la Compra: $<?= number_format(esc($venta['total']), 2, ',', '.') ?>
                    </div>
                    <?php if (!empty($venta['detalles'])): ?>
                        <div class="table-responsive mb-3">
                            <table class="table productos-table mb-0">
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
                                            <td>$<?= number_format($detalle['precio_unitario'], 2, ',', '.') ?></td>
                                            <td>$<?= number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                        <a href="<?= base_url('ventas/ticket/' . $venta['id']) ?>" target="_blank" class="btn btn-ticket">
                            <i class="fas fa-file-pdf me-2"></i>Mostrar Ticket
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="sin-compras text-center">
                <h3>Aún no has realizado ninguna compra.</h3>
                <p class="text-muted">¡Los productos que compres aparecerán aquí!</p>
                <a href="<?= base_url('catalogo') ?>" class="btn btn-explorar mt-3">Explorar Catálogo</a>
            </div>
        <?php endif; ?>
        <div class="text-center my-4">
        <a href="<?= base_url('/') ?>" class="btn btn-main btn-custom px-4">
            <i class="fas fa-arrow-left me-2"></i>Volver a la página principal
        </a>
    </div>
    </div>
</body>
</html>