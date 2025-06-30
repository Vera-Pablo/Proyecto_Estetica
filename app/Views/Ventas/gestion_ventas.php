<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestión de Ventas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body>
    <div class="gestion-container container mt-5 mb-5">
        <div class="text-center">
            <h1 class="gestion-header">Gestión de Ventas</h1>
        </div>
        <div class="text-left mb-4">
            <a href="<?= base_url('panel_admin') ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Volver al Panel Admin
            </a>
        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <?php if (session()->getFlashdata('mensaje')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('mensaje') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (empty($ventas)): ?>
                    <div class="alert alert-warning text-center">No hay ventas registradas.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-custom">
                            <thead class="table-dark-custom">
                                <tr>
                                    <th>Venta Nº</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Productos</th>
                                    <th>Ticket</th> <!-- Nueva columna -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ventas as $venta): ?>
                                    <tr>
                                        <td><?= $venta['id'] ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></td>
                                        <td><?= $venta['cliente_nombre'] . ' ' . $venta['cliente_apellido'] ?></td>
                                        <td>$<?= number_format($venta['total'], 2) ?></td>
                                        <td>
                                            <ul>
                                            <?php if (!empty($venta['detalles'])): ?>
                                                <?php foreach ($venta['detalles'] as $detalle): ?>
                                                    <li>
                                                        <?= esc($detalle['producto_nombre']) ?> - $<?= number_format($detalle['precio'], 2) ?> x <?= $detalle['cantidad'] ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li>No hay productos</li>
                                            <?php endif; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('ventas/ticket/' . $venta['id']) ?>" target="_blank" class="btn btn-primary btn-sm w-100 btn-rect">
                                                <i class="fas fa-file-pdf me-2"></i>Ver Ticket
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </body>
</html>