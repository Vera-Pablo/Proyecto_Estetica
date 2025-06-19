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
        <h1 class="gestion-header">Gestión de Todas las Ventas</h1>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Filtrar Ventas</h5>
            <form action="<?= site_url('admin/ventas') ?>" method="get" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="fecha_inicio" class="form-label">Desde</label>
                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?= esc($filtros_aplicados['fecha_inicio'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label for="fecha_fin" class="form-label">Hasta</label>
                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?= esc($filtros_aplicados['fecha_fin'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label for="cliente_id" class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-select">
                        <option value="">Todos los clientes</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>" <?= (isset($filtros_aplicados['cliente_id']) && $filtros_aplicados['cliente_id'] == $cliente['id']) ? 'selected' : '' ?>>
                                <?= esc($cliente['nombre'] . ' ' . $cliente['apellido']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filtrar</button>
                    <a href="<?= site_url('admin/ventas') ?>" class="btn btn-secondary"><i class="fas fa-eraser"></i> Limpiar</a>
                </div>
            </form>
        </div>
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
                <div class="alert alert-warning text-center">No hay ventas que coincidan con los filtros seleccionados.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover table-custom">
                        <thead class="table-dark-custom">
                            <tr>
                                <th>ID Venta</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th style="width: 20%;">Cambiar Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?= $venta['id'] ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></td>
                                    <td><?= esc($venta['nombre'] . ' ' . $venta['apellido']) ?></td>
                                    <td>$<?= number_format($venta['total'], 2) ?></td>
                                    <td>
                                        <form action="<?= site_url('admin/ventas/actualizar_estado/' . $venta['id']) ?>" method="post" class="d-flex">
                                            <select name="estado" class="form-select form-select-sm">
                                                <option value="pendiente" <?= $venta['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                                <option value="pagado" <?= $venta['estado'] == 'pagado' ? 'selected' : '' ?>>Pagado</option>
                                                <option value="cancelado" <?= $venta['estado'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-success ms-2" title="Guardar estado">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('ventas/ver/' . $venta['id']) ?>" class="btn btn-sm btn-info" title="Ver Detalle">
                                            <i class="fas fa-eye"></i>
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