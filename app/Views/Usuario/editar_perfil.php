<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Editar mis Datos</h2>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('/usuario/actualizar') ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?= esc($usuario['nombre']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="<?= esc($usuario['apellido']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" class="form-select" required>
                        <option value="femenino" <?= $usuario['sexo'] == 'femenino' ? 'selected' : '' ?>>Femenino</option>
                        <option value="masculino" <?= $usuario['sexo'] == 'masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="otro" <?= $usuario['sexo'] == 'otro' ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" value="<?= esc($usuario['usuario']) ?>" required>
                </div>
                
                <div class="text-end">
                    <a href="<?= base_url('/panel') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>