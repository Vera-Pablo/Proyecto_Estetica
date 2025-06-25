<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-principal.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
</head>
<body>

<?php 
    // Incluimos el nav_home para mantener la consistencia
    echo view('partials/nav_home'); 
?>

<div class="gestion-container container mt-5 text-center">
    
    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="card shadow-lg p-4">
            <div class="card-body">
                <h1 class="gestion-header" style="font-size: 3rem;">¡Operación Exitosa!</h1>
                <p class="lead"><?= session()->getFlashdata('mensaje') ?></p>
                <hr>
                <p>Hemos recibido tu pedido correctamente. Puedes ver el detalle en tu historial de compras.</p>
                <div class="mt-4">
                    <a href="<?= site_url('/ventas') ?>" class="btn btn-cta-gestion">Ver mi historial de compras</a>
                    <a href="<?= site_url('/catalogo') ?>" class="btn btn-secondary">Seguir comprando</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="card shadow-lg p-4">
            <div class="card-body">
                <h1 class="gestion-header" style="font-size: 3rem;">Gracias</h1>
                <p class="lead">Tu operación ha sido procesada.</p>
                <a href="<?= site_url('/') ?>" class="btn btn-primary">Volver a la página principal</a>
            </div>
        </div>
    <?php endif; ?>
    
</div>

<?php 
    // Incluimos el footer
    echo view('partials/footer'); 
?>

</body>
</html>