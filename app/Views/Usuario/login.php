<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-login.css')?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <div class="row shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="col-6 m-0 p-0 d-none d-md-block">
                    <img src="<?= base_url('assets/img/bg-login.jpg') ?>" alt="Fondo de estetica" class="img-fluid h-100 d-none d-md-block " style="object-fit: cover;">
                </div>
            
                <div class="col-md-6 bg-white p-4 d-flex flex-column justify-content-center">
                    <div class="col-md-6 mx-auto mb-4">
                        <h2 class="text-center">Iniciar sesión</h2>
                    </div>
                
                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('/usuario/autenticar') ?>" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-vb">Ingresar</button>
                    </div>
                    </form>

                    <div class="text-center mt-3">
                    <a href="<?= base_url('registrar') ?>">¿No tenés cuenta? Registrate</a>
                    </div> 
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>