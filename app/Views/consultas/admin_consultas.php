<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Consultas</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/estilos-consultaAdmin.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
    </head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-4">
                    <a href="<?= base_url('panel_admin') ?>" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Volver al Panel de Administrador
                    </a>
                </div>
                <h1 class="mb-5 text-center">Gestión de Consultas de Clientes</h1>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($consultas)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <!--<th>ID</th>-->                                            
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Asunto</th>
                                            <th>Mensaje</th>
                                            <!-- th>Estado</th>-->
                                            <th>Fecha</th>
                                            <!-- <th>Acciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($consultas as $consulta): ?>
                                            <tr>
                                                <!--<td><?= $consulta['id'] ?></td>-->
                                                <td><?= esc($consulta['nombre']) ?></td>
                                                <td><?= esc($consulta['email']) ?></td>
                                                <td><?= esc($consulta['asunto']) ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#mensajeModal<?= $consulta['id'] ?>">
                                                        <i class="bi bi-eye"></i> Ver Mensaje
                                                    </button>
                                                        <div class="modal fade" id="mensajeModal<?= $consulta['id'] ?>" tabindex="-1" aria-labelledby="mensajeModalLabel<?= $consulta['id'] ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="mensajeModalLabel<?= $consulta['id'] ?>">Mensaje de <?= esc($consulta['nombre']) ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Asunto:</strong> <?= esc($consulta['asunto']) ?></p>
                                                                    <p><?= nl2br(esc($consulta['mensaje'])) ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!--<td>
                                                    <span class="badge rounded-pill <?= ($consulta['estado'] == 'Abierto') ? 'badge-abierto' : 'badge-cerrado' ?>">
                                                        <?= esc($consulta['estado']) ?>
                                                    </span>
                                                </td>-->
                                                <td><?= date('d/m/Y H:i', strtotime($consulta['created_at'])) ?></td>
                                                <!-- <td>
                                                    <a href="<?= base_url('admin/consultas/cambiar-estado/' . $consulta['id']) ?>" class="btn btn-sm <?= ($consulta['estado'] == 'Abierto') ? 'btn-success' : 'btn-warning' ?>">
                                                        <?= ($consulta['estado'] == 'Abierto') ? '<i class="bi bi-check-circle"></i> Marcar Cerrada' : '<i class="bi bi-folder2-open"></i> Marcar Abierta' ?>
                                                    </a>
                                                </td>-->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info text-center" role="alert">
                                <i class="bi bi-info-circle"></i> No hay consultas registradas en este momento.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>