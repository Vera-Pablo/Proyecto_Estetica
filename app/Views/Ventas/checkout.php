<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-tienda.css') ?>" rel="stylesheet">
</head>
<body>

<div class="gestion-container container mt-5">
    <div class="text-center">
        <h1 class="gestion-header">Finalizar Compra</h1>
    </div>

    <form action="<?= site_url('venta/procesar') ?>" method="post">
        <div class="row">
            <div class="col-lg-7">
                <div class="card shadow-lg mb-4">
                    <div class="card-body">
                        <h4>Tus Datos</h4>
                        <hr>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" value="<?= esc(session('nombre') . ' ' . session('apellido')) ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= esc(session('email')) ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-lg">
                     <div class="card-body">
                        <h4 class="card-title mb-3">Resumen del Pedido</h4>
                        <ul class="list-group list-group-flush">
                            <?php foreach($items as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $item['cantidad'] ?>x <?= esc($item['producto']['nombre']) ?>
                                <span>$<?= number_format($item['producto']['precio'] * $item['cantidad'], 2) ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h3>Total</h3>
                            <h3>$<?= number_format($total, 2) ?></h3>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-cta-gestion btn-lg">Confirmar y Pagar</button>
                            <a href="<?= site_url('catalogo') ?>" class="btn btn-secondary btn-lg mt-2">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>