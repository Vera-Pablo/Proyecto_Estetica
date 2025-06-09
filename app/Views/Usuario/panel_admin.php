<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Panel del Administrador</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/estilos-admin.css') ?>" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5 ">
            <h2 class="mb-4 text-center">Panel de Control - Administrador</h2>

            <div class="row g-4">
                <!-- Productos -->
                <div class="col-md-6 col-lg-3">
                    <div class="card text-white shadow-lg">
                        <div class="card-body custom-productos text-center">
                            <a href="<?= base_url('productos') ?>" class="btn btn-lg">
                                <h3 class="card-title">Productos</h3>
                                <h6 class="card-text ">Agregar, editar y eliminar productos.</h6>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Categorías -->
                <div class="col-md-6 col-lg-3">
                    <div class="card text-white shadow-lg">
                        <div class="card-body custom-categorias text-center">
                            <a href="<?= base_url('categorias') ?>" class="btn  btn-lg">
                                <h3 class="card-title">Categorías</h3>
                                <h6 class="card-text">Gestionar categorías de productos.</h6>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ventas -->
                <div class="col-md-6 col-lg-3">
                    <div class="card text-white shadow-lg">
                        <div class="card-body custom-ventas text-center">
                            <a href="<?= base_url('ventas') ?>" class="btn btn-lg">
                                <h3 class="card-title">Ventas</h3>
                                <h6 class="card-text">Vistas de ventas y detalles de compras.</h6>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Usuarios -->
                <div class="col-md-6 col-lg-3">
                    <div class="card text-white shadow-lg">
                        <div class="card-body custom-usuarios text-center">                            
                            <a href="<?= base_url('usuarios') ?>" class="btn btn-lg">
                                <h3 class="card-title">Usuarios</h3>
                                <h6 class="card-text">Vistas de usuarios activos o inactivos.</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="<?= base_url('/usuario/logout') ?>" class="btn btn-danger">Cerrar sesión</a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
