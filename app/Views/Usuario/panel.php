<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">¡Bienvenido, <?= esc(session()->get('nombre')) ?>!</h2>
            
            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6">
                    <h5>Datos de tu cuenta</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nombre:</strong> <?= esc(session()->get('nombre')) ?></li>
                        </ul>
                </div>
                <div class="col-md-6 text-center">
                    <img src="<?= base_url('assets/img/usuario.png') ?>" alt="Perfil" class="img-thumbnail" style="max-width: 150px;">
                </div>
            </div>

           <div class="mt-4 d-flex justify-content-between">
            <a href="<?= base_url('/') ?>" class="btn btn-primary">Página Principal</a>
            <div>
                <a href="<?= base_url('ventas') ?>" class="btn btn-info">Mis Compras</a> 
                <a href="<?= base_url('/usuario/editar') ?>" class="btn btn-warning">Editar mis Datos</a>
                <a href="<?= base_url('/usuario/logout') ?>" class="btn btn-danger">Cerrar Sesión</a>
            </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>