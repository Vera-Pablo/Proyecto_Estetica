<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>detalle</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-detalle.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
        
    <body>
        <div class="container mt-5">
            <?php if (isset($producto)): ?>
                <div class="row">
                    <!-- Imagen -->
                    <div class="col-md-6">
                        <img src="<?= base_url('assets/img/' . $producto['imagen']) ?>" class="img-fluid rounded shadow" alt="<?= esc($producto['nombre']) ?>">
                    </div>

                    <!-- Información -->
                    <div class="col-md-6">
                        <h2><?= esc($producto['nombre']) ?></h2>
                        <p class="text-muted">Categoría: <?= esc($producto['categoria']) ?></p>
                        <p><?= esc($producto['descripcion']) ?></p>
                        <p class="fs-4 fw-bold text-success">$<?= number_format($producto['precio'], 2) ?></p>

                        <!-- Formulario para agregar al carrito -->
                        <form action="<?= base_url('/carrito/agregar') ?>" method="post" class="d-flex align-items-center gap-2 mt-3">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <label for="cantidad" class="form-label mb-0">Cantidad:</label>
                            <input type="number" name="cantidad" value="1" min="1" class="form-control w-25">
                            <button type="submit" class="btn btn-success">Agregar al carrito</button>
                        </form>

                        <!-- Botón de favoritos (opcional) -->
                        <form action="<?= base_url('/favoritos/agregar') ?>" method="post" class="mt-3">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <button type="submit" class="btn btn-outline-warning">Agregar a favoritos</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger text-center">
                    Producto no encontrado.
                </div>
            <?php endif; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>