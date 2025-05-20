<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Consulta enviada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu hoja de estilos personalizada -->
    <link href="<?= base_url('assets/css/gracias.css') ?>" rel="stylesheet">
    </head>

    <body>

    <div class="envelope mb-5"></div>

    <div id="mensaje" class="text-center mensaje-final">
        <h2 class="mb-3">¡Consulta enviada con éxito!</h2>
        <p class="mb-4">Muchas gracias por contactarnos. Te responderemos pronto.</p>
        <a href="<?= base_url("/")?>" class="btn btn-primary">Volver a la página principal</a>
    </div>

    <!-- Script para mostrar mensaje después de la animación -->
    <script>
        setTimeout(() => {
        document.getElementById('mensaje').classList.add('mostrar');
        }, 3000);
    </script>

    </body>
</html>
