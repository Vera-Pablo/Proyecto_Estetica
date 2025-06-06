<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Registrar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/estilos-registrar.css') ?>" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container shadow-lg" style="border-radius: 20px;">
            <div class="left-section text-center">
                <img src="<?= base_url('assets/img/VB.png') ?>" alt="Logo" class="img-fluid mb-3" style="max-width: 120px;">
                <h1>Bienvenido</h1>
                <a href="<?= base_url('quienes_somos') ?>">
                    <button type="button" class="about-us btn btn-outline-light mt-3">Sobre Nosotros</button>
                </a>
            </div>

            <div class="right-section p-4">
                <h2 class="mb-4">Registrarse Aquí</h2>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/usuario/guardarRegistro') ?>" method="post">
                    <input type="text" placeholder="Nombre" name="nombre" required>
                    <input type="text" placeholder="Usuario" name="usuario" required>
                    <input type="email" placeholder="Correo electrónico" name="email" required>
                    <input type="password" placeholder="Contraseña" name="pass" required>

                    <div class="text-center mt-2">
                        <a href="<?= base_url('login') ?>">¿Ya tenés cuenta? Iniciá sesión</a>
                    </div>

                    <button type="submit" class="register btn btn-vb mt-3">Registrarse</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
