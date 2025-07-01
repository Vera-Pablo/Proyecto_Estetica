<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestionar Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container gestion-container my-5">
        <div class="text-center mb-4">
            <h1 class="gestion-header">Gestión de Productos</h1>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row mb-4 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control pastel-input" placeholder="Buscar por nombre de producto...">
                        </div>
                    </div>
                    <div class="col-md-7 text-md-end mt-3 mt-md-0">
                        <a href="<?= base_url('panel_admin') ?>" class="btn btn-secondary-custom me-2">
                            <i class="fas fa-arrow-left me-1"></i> Panel Principal
                        </a>
                        <a href="<?= base_url('crear') ?>" class="btn btn-cta-gestion">
                            <i class="fas fa-plus me-1"></i> Agregar Producto
                        </a>
                    </div>
                </div>

                <?php if (session()->getFlashdata('mensaje')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('mensaje') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php $productos = isset($productos) ? $productos : []; ?>
                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle">
                        <thead class="table-dark-custom">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productsTable">
                            <?php if (!empty($productos)): ?>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td class="text-muted">#<?= esc($producto['id']) ?></td>
                                        <td class="product-name fw-medium"><?= esc($producto['nombre']) ?></td>
                                        <td>$<?= esc(number_format($producto['precio'], 2)) ?></td>
                                        <td><?= esc($producto['categoria']) ?></td>
                                        <td><?= esc($producto['stock']) ?></td>
                                        <td>
                                            <span class="badge <?= $producto['estado'] == 1 ? 'bg-success-custom' : 'bg-danger-custom' ?>">
                                                <?= $producto['estado'] == 1 ? 'Activo' : 'Inactivo' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('/productos/editar/' . $producto['id']) ?>" class="btn btn-sm btn-edit-custom" title="Editar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <?php if ($producto['estado'] == 1): ?>
                                                <a href="<?= base_url('/productos/desactivar/' . $producto['id']) ?>" class="btn btn-sm btn-danger-custom" title="Desactivar" onclick="return confirm('¿Estás seguro que deseas desactivar este producto?')">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= base_url('/productos/activar/' . $producto['id']) ?>" class="btn btn-sm btn-success-custom" title="Activar">
                                                    <i class="fas fa-toggle-off"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">No hay productos cargados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#productsTable tr');
            rows.forEach(row => {
                let productNameCell = row.querySelector('.product-name');
                if (productNameCell) {
                    let productName = productNameCell.textContent.toLowerCase();
                    row.style.display = productName.includes(filter) ? '' : 'none';
                }
            });
        });
    </script>
</body>
</html>