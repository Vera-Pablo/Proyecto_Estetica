<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-tienda.css') ?>" rel="stylesheet">
</head>
<body>

<div class="gestion-container container mt-5">
    <div class="text-center">
        <h1 class="gestion-header">Carrito de Compras</h1>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('mensaje') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($items)): ?>
                <form action="<?= site_url('carrito/actualizar') ?>" method="post">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom">
                            <thead class="table-dark-custom">
                                <tr>
                                    <th style="width: 10%;">Imagen</th>
                                    <th style="width: 35%;">Producto</th>
                                    <th style="width: 15%;">Precio</th>
                                    <th style="width: 15%;" class="text-center">Cantidad</th>
                                    <th style="width: 15%;">Subtotal</th>
                                    <th style="width: 10%;" class="text-center">Quitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php foreach ($items as $item): ?>
                                    <?php $subtotal = $item['producto']['precio'] * $item['cantidad']; $total += $subtotal; ?>
                                    <tr>
                                        <td>
                                            <img src="<?= base_url('assets/img/' . $item['producto']['imagen']) ?>" alt="<?= esc($item['producto']['nombre']) ?>" class="img-fluid rounded-3 product-image">
                                        </td>
                                        <td class="align-middle">
                                            <h5><?= esc($item['producto']['nombre']) ?></h5>
                                        </td>
                                        <td class="align-middle">$<?= number_format($item['producto']['precio'], 2) ?></td>
                                        <td class="align-middle text-center">
                                            <input type="number" name="cantidades[<?= $item['id'] ?>]" class="form-control form-control-sm quantity-input" value="<?= $item['cantidad'] ?>" min="1">
                                        </td>
                                        <td class="align-middle">$<?= number_format($subtotal, 2) ?></td>
                                        <td class="align-middle text-center">
                                            <a href="<?= site_url('carrito/eliminar/' . $item['id']) ?>" class="btn btn-sm btn-danger-custom" title="Eliminar producto">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-summary mt-4">
                        <div class="row justify-content-end">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Resumen del Pedido</h4>
                                        <div class="d-flex justify-content-between">
                                            <h5>Subtotal</h5>
                                            <h5>$<?= number_format($total, 2) ?></h5>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <h3>Total</h3>
                                            <h3>$<?= number_format($total, 2) ?></h3>
                                        </div>
                                        <div class="d-grid gap-2 mt-4">
                                            <a href="<?= site_url('checkout') ?>" class="btn btn-cta-gestion">Proceder al Pago</a>
                                            <button type="submit" class="btn btn-secondary-custom">Actualizar Cantidades</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                 <div class="text-center p-5">
                    <h3>Tu carrito de compras está vacío.</h3>
                    <p class="text-muted">¡Explora nuestro catálogo y agrega productos!</p>
                    <a href="<?= site_url('catalogo') ?>" class="btn btn-cta-gestion mt-3">Ver Catálogo</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>