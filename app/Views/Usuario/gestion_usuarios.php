<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container gestion-container my-5">
        <div class="text-center mb-4">
            <h1 class="gestion-header">Gestión de Usuarios</h1>
        </div>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('mensaje') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle">
                        <thead class="table-dark-custom">
                            <tr>
                                <th>ID</th>
                                <th>Nombre y Apellido</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= $usuario['id'] ?></td>
                                    <td><?= esc($usuario['nombre']) . ' ' . esc($usuario['apellido']) ?></td>
                                    <td><?= esc($usuario['email']) ?></td>
                                    <td><?= esc($usuario['rol']) ?></td>
                                    <td>
                                        <?php if ($usuario['estado'] == 1): ?>
                                            <span class="badge bg-success-custom">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-custom">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('Usuario/editar_usuario/' . $usuario['id']) ?>" class="btn btn-sm btn-edit-custom" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <?php if ($usuario['estado'] == 1): ?>
                                            <a href="<?= base_url('/admin/usuarios/desactivar/' . $usuario['id']) ?>" class="btn btn-sm btn-danger-custom" title="Desactivar" onclick="return confirm('¿Desactivar este usuario?')">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('/admin/usuarios/activar/' . $usuario['id']) ?>" class="btn btn-sm btn-success-custom" title="Activar">
                                                <i class="fas fa-toggle-off"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <a href="<?= base_url('panel_admin') ?>" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-1"></i> Volver al Panel Principal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>