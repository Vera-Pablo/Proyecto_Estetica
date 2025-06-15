<div class="container mt-5 mb-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px;">
        <h2 class="text-center mb-4">Editando Usuario: <?= esc($usuario['nombre']) ?></h2>

        <form action="<?= base_url('/admin/usuarios/actualizar/' . $usuario['id']) ?>" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= esc($usuario['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="<?= esc($usuario['apellido']) ?>" required>
            </div>
             <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc($usuario['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" class="form-select">
                    <option value="cliente" <?= $usuario['rol'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                    <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            
            <div class="text-end">
                <a href="<?= base_url('/admin/usuarios') ?>" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>