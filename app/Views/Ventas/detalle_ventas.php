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
    
    <div class="text-center">
        <h1 class="gestion-header">Detalle de la Compra</h1>
    </div>

    <div class="p-4 mb-4 bg-light rounded shadow-sm">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <h6 class="text-muted">ID de Venta</h6>
                <p class="fs-5 fw-bold">#<?= $venta['id'] ?></p>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="text-muted">Fecha de Compra</h6>
                <p class="fs-5"><?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></p>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="text-muted">Total Pagado</h6>
                <p class="fs-5 fw-bold">$<?= number_format($venta['total'], 2) ?></p>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="text-muted">Estado del Pedido</h6>
                <p class="fs-5">
                    <?php
                        $estado = strtolower($venta['estado']);
                        $claseBadge = 'bg-secondary';
                        if ($estado == 'pagado') $claseBadge = 'bg-success';
                        if ($estado == 'pendiente') $claseBadge = 'bg-warning text-dark';
                        if ($estado == 'cancelado') $claseBadge = 'bg-danger';
                    ?>
                    <span class="badge <?= $claseBadge ?> p-2"><?= esc(ucfirst($venta['estado'])) ?></span>
                </p>
            </div>
        </div>
    </div>

    <h3 class="mb-3">Productos en este pedido</h3>
    <div class="table-responsive shadow-sm border rounded">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="p-3">Producto</th>
                    <th class="p-3 text-center">Cantidad</th>
                    <th class="p-3 text-end">Precio Unitario</th>
                    <th class="p-3 text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles as $detalle): ?>
                    <tr>
                        <td class="p-3"><?= esc($detalle['producto_nombre']) ?></td>
                        <td class="p-3 text-center"><?= $detalle['cantidad'] ?></td>
                        <td class="p-3 text-end">$<?= number_format($detalle['precio_unitario'], 2) ?></td>
                        <td class="p-3 text-end fw-bold">$<?= number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="text-center mt-4">
        <a href="<?= site_url('/ventas') ?>" class="btn btn-secondary-custom">
            <i class="fas fa-arrow-left me-2"></i>Volver a Mi Historial
        </a>
    </div>
</div>

</body>
</html> 