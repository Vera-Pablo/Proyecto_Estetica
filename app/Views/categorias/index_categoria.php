<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Gestión Categoría</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-principal.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
        
    <body>
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Listado de Categorías</h2>

            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
            <?php endif; ?>

            <div class="container mb-2">
                <div class="row ">
                    <div class="col text-end">
                        <a href="<?= base_url('panel_admin') ?>" class="btn btn-success">Panel Principal</a>
                        <a href="<?= base_url('/categorias/crear') ?>" class="btn btn-success">Nueva Categoría</a>
                    </div>
                </div>
            </div>
            <?php if (!empty($categorias)): ?>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?= $categoria['id'] ?></td>
                                <td><?= esc($categoria['nombre']) ?></td>
                                <td><?= $categoria['estado'] == 1 ? 'Activa' : 'Inactiva' ?></td>
                                <td>
                                    <a href="<?= base_url('/categorias/editar/' . $categoria['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="<?= base_url('/categorias/desactivar/' . $categoria['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Deseás desactivar esta categoría?')">Desactivar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No hay categorías registradas.</p>
            <?php endif; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>