<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-login.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center vh-100 align-items-center">
                <div class="col">
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center shadow-lg rounded-5 p-5 gap-3" style= "width: 30%; height:70%" ">
                    <img src="<?= base_url('assets/img/bg-login.jpg') ?>" alt="Logo" class="img-fluid w-25 ">
                    <h1 class="text-center">Bienvenido</h1>
                    <p class="text-center">Inicia sesión para continuar</p>
                </div>
            </div>   
            <div class="col">
                <div class="col-md-6 d-flex flex-column align-items-center justify-content-center shadow-lg rounded-5 p-5 gap-3" style= "width: 30%; height:70%" ">
                        <img src="<?= base_url('assets/img/VB.png') ?>" alt="Logo" class="img-fluid w-25 ">
                        <h1 class="text-center">Inicio de Sesión</h1>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <form class="w-100 d-flex flex-column" action="<?= base_url('usuario/login') ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary ">Iniciar Sesión</button>
                        </form>
                        <p class="mt-3 text-center">¿No tienes una cuenta? <a href="<?= base_url('usuario/registro') ?>">Regístrate aquí</a></p>
                    </div>
                </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>