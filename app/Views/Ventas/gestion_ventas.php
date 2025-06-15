<div class="container mt-5 mb-5" style="min-height: 70vh;">
    <h1 class="text-center mb-4">Gestión de Todas las Ventas</h1>

    <?php if (!empty($ventas)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Venta</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= esc($venta['id']) ?></td>
                            <td><?= esc($venta['nombre_usuario']) . ' ' . esc($venta['apellido_usuario']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime(esc($venta['fecha']))) ?></td>
                            <td class="text-end">$<?= number_format(esc($venta['total']), 2, ',', '.') ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('ventas/ver/' . $venta['id']) ?>" class="btn btn-sm btn-info">Ver Detalle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary text-center">No se ha realizado ninguna venta hasta el momento.</div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= base_url('panel_admin') ?>" class="btn btn-success">Volver al Panel Principal</a>
    </div>
</div>