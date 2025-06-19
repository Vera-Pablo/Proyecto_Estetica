<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Favoritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-tienda.css') ?>" rel="stylesheet">
</head>
<body>
    
<div class="gestion-container container mt-5">
    <div class="text-center">
        <h1 class="gestion-header">Mis Favoritos</h1>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            
            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('mensaje') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($favoritos)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-custom">
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
                                    <td class="align-middle">
                                        <h5><?= esc($item['producto_nombre']) ?></h5>
                                    </td>
                                    <td class="align-middle">
                                        $<?= number_format($item['precio'], 2) ?>
                                    </td>
                                    <td class="align-middle text-center">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>