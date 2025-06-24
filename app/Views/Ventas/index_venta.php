<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Historial de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-tienda.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="gestion-container container-lg my-5">
        <h1 class="gestion-header text-center mb-5">Mi Historial de Compras</h1>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (!empty($ventas)): ?>
            <?php foreach ($ventas as $venta): ?>
                <div class="card mb-4 shadow-sm history-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong class="order-id">Orden #<?= esc($venta['id']) ?></strong>
                            <span class="order-date">Fecha: <?= date('d/m/Y', strtotime(esc($venta['fecha']))) ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6 class="text-muted mb-0">Estado</h6>
                                <?php
                                    $estado = strtolower($venta['estado']);
                                    $claseBadge = 'bg-secondary';
                                    if ($estado == 'pagado') $claseBadge = 'bg-success';
                                    if ($estado == 'pendiente') $claseBadge = 'bg-warning text-dark';
                                    if ($estado == 'cancelado') $claseBadge = 'bg-danger';
                                ?>
                                <span class="badge <?= $claseBadge ?> fs-6"><?= esc(ucfirst($venta['estado'])) ?></span>
                            </div>
                            <div class="col-md-5 text-md-center">
                                <h6 class="text-muted mb-0">Total de la Compra</h6>
                                <p class="total-amount mb-0">$<?= number_format(esc($venta['total']), 2, ',', '.') ?></p>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <a href="<?= base_url('ventas/ver/' . $venta['id']) ?>" class="btn btn-view-detail">
                                    <i class="fas fa-eye me-2"></i>Ver Detalle
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center p-5 mt-4 bg-light rounded shadow-sm">
                <h3>Aún no has realizado ninguna compra.</h3>
                <p class="text-muted">¡Los productos que compres aparecerán aquí!</p>
                <a href="<?= base_url('catalogo') ?>" class="btn btn-cta-gestion mt-3">Explorar Catálogo</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>