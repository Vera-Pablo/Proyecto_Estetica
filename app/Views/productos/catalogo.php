<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catalogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/estilos-catalogo.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Catálogo de Productos</h1>

        <form action="<?= base_url('catalogo') ?>" method="get" class="row mb-4 justify-content-center">
            <div class="col-md-4">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-buscar w-100">Buscar</button>
            </div>
        </form>

        <div class="row">
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            <img src="<?= base_url('assets/img/' . $producto['imagen']) ?>" class="card-img-top" alt="<?= esc($producto['nombre']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($producto['nombre']) ?></h5>
                                <p class="card-text"><?= esc($producto['descripcion']) ?></p>
                                <p class="card-text fw-bold">$<?= number_format($producto['precio'], 2) ?></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <a href="<?= base_url('/productos/detalle/' . $producto['id']) ?>" class="btn btn-sm btn-outline-info">Ver más</a>
                                
                                <div class="d-flex">
                                    <a href="<?= site_url('/favoritos/agregar/' . $producto['id']) ?>" class="btn btn-sm btn-danger me-2" title="Añadir a favoritos">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    
                                    <form action="<?= base_url('/carrito/agregar') ?>" method="post" class="mb-0">
                                        <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-success" title="Agregar al carrito">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No hay productos para mostrar.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>