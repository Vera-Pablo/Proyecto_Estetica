<div class="gestion-container container mt-5">
    <div class="text-center">
        <h1 class="gestion-header">Mis Favoritos</h1>
    </div>

    <div class="card shadow-lg">
        <div class="card-body p-4">
            
            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('mensaje') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($favoritos)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle">
                        <thead class="table-dark-custom">
                            <tr>
                                <th style="width: 15%;">Imagen</th>
                                <th style="width: 45%;">Producto</th>
                                <th style="width: 20%;">Precio</th>
                                <th style="width: 20%;" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($favoritos as $item): ?>
                                <tr>
                                    <td>
                                        <img src="<?= base_url('assets/img/' . $item['imagen']) ?>" alt="<?= esc($item['producto_nombre']) ?>" class="img-fluid rounded-3 product-image">
                                    </td>
                                    <td>
                                        <h5><?= esc($item['producto_nombre']) ?></h5>
                                    </td>
                                    <td>
                                        $<?= number_format($item['precio'], 2) ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= site_url('/favoritos/eliminar/' . $item['producto_id']) ?>" class="btn btn-sm btn-danger-custom" title="Eliminar de favoritos">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <form action="<?= base_url('/carrito/agregar') ?>" method="post" class="d-inline">
                                            <input type="hidden" name="producto_id" value="<?= $item['producto_id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-success-custom" title="Agregar al carrito">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="<?= site_url('favoritos/agregar_todo_al_carrito') ?>" class="btn btn-cta-gestion">
                        <i class="fas fa-cart-plus me-2"></i> Agregar todo al Carrito
                    </a>
                </div>

            <?php else: ?>
                <div class="text-center p-5">
                    <h3>Tu lista de favoritos está vacía.</h3>
                    <p class="text-muted">¡Agrega productos que te encanten para verlos aquí!</p>
                    <a href="<?= site_url('catalogo') ?>" class="btn btn-cta-gestion mt-3">Ver Catálogo</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>