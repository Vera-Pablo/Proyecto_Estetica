<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestionar Productos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?= base_url('assets/css/estilos-principal.css') ?>" rel="stylesheet">
    
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

    <div class="background-video">
        </div>

    <div class="container gestion-container mt-5">
        <div class="text-center">
            <h1 class="gestion-header">Gestión de Productos</h1>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre de producto...">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="<?= base_url('panel_admin') ?>" class="btn btn-secondary-custom">
                            <i class="fas fa-arrow-left"></i> Panel Principal
                        </a>
                        <a href="<?= base_url('crear') ?>" class="btn btn-cta-gestion">
                            <i class="fas fa-plus"></i> Agregar Producto
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
                    <table class="table table-hover table-custom">
                        <thead class="table-dark-custom">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Categoría</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productsTable">
                            <?php if (!empty($productos)): ?>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td><?= esc($producto['id']) ?></td>
                                        <td class="product-name"><?= esc($producto['nombre']) ?></td>
                                        <td>$<?= esc(number_format($producto['precio'], 2)) ?></td>
                                        <td><?= esc($producto['categoria']) ?></td>
                                        <td>
                                            <span class="badge <?= $producto['estado'] == 1 ? 'bg-success-custom' : 'bg-danger-custom' ?>">
                                                <?= $producto['estado'] == 1 ? 'Activo' : 'Inactivo' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('/productos/editar/' . $producto['id']) ?>" class="btn btn-sm btn-warning-custom" title="Editar">
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
                                    <td colspan="6" class="text-center">No hay productos cargados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para la búsqueda en tiempo real
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#productsTable tr');

            rows.forEach(row => {
                let productName = row.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>