<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel del Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="<?= base_url('assets/css/estilos-admin.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="text-center">
            <h2 class="mb-2">Panel de Control</h2>
            <p class="text-muted">Administrador</p>
        </div>

        <div class="d-flex justify-content-end mb-4">
            <a href="<?= base_url('/usuario/logout') ?>" class="btn btn-danger">
                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('index_producto') ?>" class="text-decoration-none text-dark card-link">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-box-seam card-icon icon-productos"></i>
                            <h5 class="card-title">Productos</h5>
                            <p class="card-text text-muted small">Agregar, editar y gestionar el stock.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                 <a href="<?= base_url('categorias') ?>" class="text-decoration-none text-dark card-link">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-tags card-icon icon-categorias"></i>
                            <h5 class="card-title">Categorías</h5>
                            <p class="card-text text-muted small">Administrar las categorías de productos.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('admin/consultas') ?>" class="text-decoration-none text-dark card-link">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-chat-dots card-icon icon-consultas"></i>
                            <h5 class="card-title">Consultas</h5>
                            <p class="card-text text-muted small">Ver y gestionar consultas de clientes.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('admin/ventas') ?>" class="text-decoration-none text-dark card-link">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-receipt-cutoff card-icon icon-ventas"></i>
                            <h5 class="card-title">Ventas</h5>
                            <p class="card-text text-muted small">Ver historial y detalles de compras.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url('admin/usuarios') ?>" class="text-decoration-none text-dark card-link">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-people card-icon icon-usuarios"></i>
                            <h5 class="card-title">Usuarios</h5>
                            <p class="card-text text-muted small">Gestionar usuarios activos e inactivos.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>