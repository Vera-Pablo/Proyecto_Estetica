<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container gestion-container my-5">
        <div class="text-center mb-4">
            <h2 class="gestion-header" style="font-size:2.5rem;">
                <i class="fa fa-user-edit me-2 text-pink"></i>
                Editar Usuario
            </h2>
            <p class="text-muted mb-0" style="font-size:1.1rem;">
                Modifica los datos del usuario
            </p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/admin/usuarios/actualizar/' . $usuario['id']) ?>" method="post" class="card p-4 shadow-sm border-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-medium">
                                <i class="fa fa-user me-1 text-pink"></i> Nombre
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control pastel-input" value="<?= esc($usuario['nombre']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label fw-medium">
                                <i class="fa fa-user me-1 text-pink"></i> Apellido
                            </label>
                            <input type="text" name="apellido" id="apellido" class="form-control pastel-input" value="<?= esc($usuario['apellido']) ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label fw-medium">
                                <i class="fa fa-envelope me-1 text-pink"></i> Email
                            </label>
                            <input type="email" name="email" id="email" class="form-control pastel-input" value="<?= esc($usuario['email']) ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="rol" class="form-label fw-medium">
                                <i class="fa fa-user-tag me-1 text-pink"></i> Rol
                            </label>
                            <select name="rol" id="rol" class="form-select pastel-input">
                                <option value="cliente" <?= $usuario['rol'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                                <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <a href="<?= base_url('gestion_usuarios') ?>" class="btn btn-secondary-custom me-2">
                            <i class="fa fa-times me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-cta-gestion">
                            <i class="fa fa-save me-1"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>