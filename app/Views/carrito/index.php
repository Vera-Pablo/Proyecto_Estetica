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

                    <div class="cart-summary-bar bg-light p-3 mt-4 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                                <h4 class="mb-0">Total del Pedido: <span class="fw-bold color-brand">$<?= number_format($total, 2) ?></span></h4>
                            </div>
                            <div class="col-md-6 text-center text-md-end">
                                <button type="submit" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-sync-alt me-1"></i> Actualizar Cantidades
                                </button>
                                <a href="<?= site_url('checkout') ?>" class="btn btn-success btn-lg">
                                    Proceder al Pago <i class="fas fa-arrow-right ms-1"></i>
                                </a>
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