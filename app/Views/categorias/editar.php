<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Editar Categoría</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-principal.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
        
    <body>
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Editar Categoría</h2>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('/categorias/actualizar/' . $categoria['id']) ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la categoría</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?= esc($categoria['nombre']) ?>" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="<?= base_url('/categorias') ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>