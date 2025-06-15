<div class="container mt-5 mb-5" style="min-height: 70vh;">
    <h1 class="text-center mb-4">Mi Historial de Compras</h1>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (!empty($ventas)): ?>
        <?php foreach ($ventas as $venta): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Orden #<?= esc($venta['id']) ?></strong>
                    <span>Fecha: <?= date('d/m/Y', strtotime(esc($venta['fecha']))) ?></span>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total de la Compra</h5>
                        <p class="card-text fs-4 fw-bold">$<?= number_format(esc($venta['total']), 2, ',', '.') ?></p>
                    </div>
                    <a href="<?= base_url('ventas/ver/' . $venta['id']) ?>" class="btn btn-primary">Ver Detalle</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Aún no has realizado ninguna compra. ¡Explora nuestro <a href="<?= base_url('catalogo') ?>">catálogo</a>!
        </div>
    <?php endif; ?>
</div>