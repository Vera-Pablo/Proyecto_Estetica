<div class="container mt-5 mb-5" style="min-height: 70vh;">
    <h1 class="text-center mb-4">Gestión de Usuarios</h1>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
    <?php endif; ?>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
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
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('/admin/usuarios/editar/' . $usuario['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <?php if ($usuario['estado'] == 1): ?>
                                <a href="<?= base_url('/admin/usuarios/desactivar/' . $usuario['id']) ?>" class="btn btn-sm btn-danger">Desactivar</a>
                            <?php else: ?>
                                <a href="<?= base_url('/admin/usuarios/activar/' . $usuario['id']) ?>" class="btn btn-sm btn-success">Activar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <a href="<?= base_url('panel_admin') ?>" class="btn btn-secondary">Volver al Panel Principal</a>
    </div>
</div>