<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= esc($producto['nombre'] ?? 'Detalle') ?> - Detalles del producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fuentes de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap" rel="stylesheet">

    <!-- Tu hoja de estilos personalizada -->
    <link rel="stylesheet" href="<?= base_url('assets/css/estilo-detalleProducto.css') ?>">
</head>
<body>
    <?php include(APPPATH . 'Views/partials/nav_home.php'); ?>
    <div class="container product-detail-section">
        <div class="row product-detail-container">
            <!-- Imagen del producto -->
            <div class="col-md-6 product-image-container">
    
                <!-- 
                    CORRECCIÓN PRINCIPAL:
                    La ruta a la imagen no debe incluir "/productos".
                    La ruta correcta es 'assets/img/' seguido del nombre de la imagen.
                -->
                <img src="<?= base_url('assets/img/' . $producto['imagen']) ?>" alt="<?= esc($producto['nombre']) ?>" class="img-fluid">

            </div>

            <!-- Información del producto -->
            <div class="col-md-6 product-info-main">

                <h1 class="product-title"><?= esc($producto['nombre']) ?></h1>

                <div class="product-price">$<?= number_format($producto['precio'], 0, ',', '.') ?></div>

                <!-- Formulario de compra -->
                <form action="<?= base_url('/carrito/agregar') ?>" method="post">
                    <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                    
                    <!-- Selector de cantidad -->
                    <div class="quantity-selector-wrapper">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <div class="quantity-selector">
                            <button type="button" class="btn" onclick="this.nextElementSibling.stepDown()">−</button>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" value="1" min="1">
                            <button type="button" class="btn" onclick="this.previousElementSibling.stepUp()">+</button>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="action-buttons d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-add-to-cart">Agregar al carrito</button>
                        <a href="<?= site_url('/favoritos/agregar/' . $producto['id']) ?>" class="btn btn-favorites">❤ Añadir a favoritos</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Descripción -->
        <div class="product-description-section">
            <h3>Descripción</h3>
            <p><?= nl2br(esc($producto['descripcion'] ?? 'No hay descripción disponible.')) ?></p>
        </div>
    </div>
    <?php include(APPPATH . 'Views/partials/footer.php'); ?>
</body>
</html>
