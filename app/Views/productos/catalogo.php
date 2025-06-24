<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catalogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/estilos-catalogo.css') ?>" rel="stylesheet">
    
    <link href="<?= base_url('assets/css/estilos-producto.css') ?>" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900&display=swap" rel="stylesheet">
    
    </head>
<body>
    <?php if (session()->get('rol') !== 'admin'): ?>
        <?php include(APPPATH . 'Views/partials/nav_home.php'); ?>
    <?php endif; ?>
    <div class="container mt-4">
        <h1 class="text-center">Catálogo de Productos</h1>

        <form action="<?= base_url('catalogo') ?>" method="get" class="row mb-4 justify-content-center">
            <div class="col-md-4">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="col">
                        <div class="product-card">
                            
                            <div class="product-image-container">
                                <img src="<?= base_url('assets/img/' . $producto['imagen']) ?>" class="card-img-top" alt="<?= esc($producto['nombre']) ?>">
                            </div>
                            
                            <div class="product-info">
                                <h6 class="product-name"><?= esc($producto['nombre']) ?></h6>
                                
                                <div class="d-flex justify-content-center align-items-center mt-auto">
                                    <p class="product-price mb-0">$<?= number_format($producto['precio'], 2, ',', '.') ?></p>
                                </div>
                            </div>
                            
                            <div class="product-actions">
                                <form action="<?= base_url('/carrito/agregar') ?>" method="post">
                                    <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                                    <input type="hidden" name="cantidad" value="1"> 
                                    
                                    <div class="d-flex gap-2 mb-2">
                                        <button type="submit" class="btn btn-add-to-cart w-100">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <a href="<?= site_url('/favoritos/agregar/' . $producto['id']) ?>" class="btn btn-favorites w-100" title="Añadir a favoritos">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                    </div>
                                </form>

                                <div class="d-grid">
                                    <a href="<?= base_url('/productos/detalles_productos/' . $producto['id']) ?>" class="btn btn-outline-secondary" title="Ver detalles">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No hay productos para mostrar.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>