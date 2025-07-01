<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nueva Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container gestion-container my-5">
        <div class="text-center mb-4">
            <h2 class="gestion-header" style="font-size:2.5rem;">
                <i class="fa fa-folder-plus me-2 text-pink"></i>
                Nueva Categoría
            </h2>
            <p class="text-muted mb-0" style="font-size:1.1rem;">Agrega una nueva categoría para tus productos</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/categorias/guardar') ?>" method="post" class="card p-4 shadow-sm border-0">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-medium">
                            <i class="fa fa-tag me-1 text-pink"></i> Nombre de la categoría
                        </label>
                        <input type="text" name="nombre" id="nombre" class="form-control pastel-input" required>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-cta-gestion me-2">
                            <i class="fa fa-save me-1"></i> Guardar
                        </button>
                        <a href="<?= base_url('/categorias') ?>" class="btn btn-secondary-custom">
                            <i class="fa fa-times me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>