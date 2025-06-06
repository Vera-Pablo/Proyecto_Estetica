<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Catalogo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-catalogo.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
        
    <body>
        <div class="container mt-4">
            <h1 class="text-center">Catálogo de Productos</h1>

            <!-- Buscador -->
            <form action="<?= base_url('detalle') ?>" method="get" class="row mb-4 justify-content-center">
                <div class="col-md-4">
                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre, categoría o letra...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-buscar w-100">Buscar</button>
                </div>
            </form>

            <!-- Grid de productos -->
            <div class="row">
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <img src="<?= base_url('assets/img/' . $producto['imagen']) ?>" class="card-img-top" alt="<?= $producto['nombre'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($producto['nombre']) ?></h5>
                                    <p class="card-text"><?= esc($producto['descripcion']) ?></p>
                                    <p class="card-text fw-bold">$<?= number_format($producto['precio'], 2) ?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <a href="<?= base_url('/productos/detalle/' . $producto['id']) ?>" class="btn btn-sm btn-outline-info">Ver más</a>
                                    <form action="<?= base_url('/carrito/agregar') ?>" method="post">
                                        <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                                        <input type="hidden" name="cantidad" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">Agregar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No hay productos para mostrar.</p>
                <?php endif; ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>