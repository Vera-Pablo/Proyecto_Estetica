<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Perfil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-principal.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
        
    <body>
        <div class="container mt-5">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">¡Bienvenido, <?= esc(session()->get('nombre')) ?>!</h2>

                <div class="row">
                <div class="col-md-6">
                    <h5>Datos de tu cuenta</h5>
                    <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre:</strong> <?= esc(session()->get('nombre')) ?></li>
                    <li class="list-group-item"><strong>Rol:</strong> <?= esc(session()->get('rol')) ?></li>
                    <!-- Si guardás más datos en la sesión como email, podrías agregarlos acá -->
                    </ul>
                </div>

                <div class="col-md-6 text-center">
                    <img src="<?= base_url('assets/img/usuario.png') ?>" alt="Perfil" class="img-thumbnail" style="max-width: 150px;">
                </div>
                </div>

                <div class="mt-4 text-end">
                <a href="<?= base_url('/usuario/logout') ?>" class="btn btn-danger">Cerrar sesión</a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>