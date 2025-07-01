<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilo-panelUsuario.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card panel-card mx-auto">
                    <div class="panel-header">
                        <h2 class="mb-0" style="color:#d72660;">¡Bienvenido, <?= esc(session()->get('nombre')) ?>!</h2>
                        <p class="mt-2 mb-0" style="color:#a81d4d; font-size:1.1rem;">Panel de usuario</p>
                    </div>
                    <div class="card-body px-4 pb-4 pt-0">
                        <div class="profile-flex mt-4">
                            <div class="profile-avatar-col">
                                <img src="<?= base_url('assets/img/usuario.png') ?>" alt="Perfil" class="avatar shadow">
                            </div>
                            <div class="profile-info-col">
                                <ul class="list-group user-info-list mb-4">
                                    <li><strong>Usuario:</strong> <?= esc(session()->get('usuario')) ?></li>
                                    <li><strong>Nombre:</strong> <?= esc(session()->get('nombre')) ?></li>
                                    <li><strong>Email:</strong> <?= esc(session()->get('email')) ?></li>
                                </ul>
                                <div class="d-flex flex-wrap gap-2 justify-content-start">
                                    <a href="<?= base_url('/') ?>" class="btn btn-main btn-custom px-4">Página Principal</a>
                                    <a href="<?= base_url('ventas') ?>" class="btn btn-sec btn-custom px-4">Mis Compras</a>
                                    <a href="<?= base_url('/usuario/logout') ?>" class="btn btn-logout btn-custom px-4">Cerrar Sesión</a>
                                </div>
                            </div>
                        </div>
                        <div class="footer-panel mt-4">
                            <span>VB Estética &copy; <?= date('Y') ?> | Tu espacio de belleza</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>