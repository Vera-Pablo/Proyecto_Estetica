<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Consultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container gestion-container my-5">
        <div class="text-center mb-4">
            <h1 class="gestion-header">Gestión de Consultas de Clientes</h1>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row mb-4 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control pastel-input" placeholder="Buscar por nombre o email...">
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <a href="<?= base_url('panel_admin') ?>" class="btn btn-secondary-custom">
                            <i class="fas fa-arrow-left me-1"></i> Panel Principal
                        </a>
                    </div>
                </div>

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

                <?php if (!empty($consultas)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-custom align-middle">
                            <thead class="table-dark-custom">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Asunto</th>
                                    <th>Mensaje</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody id="consultasTable">
                                <?php foreach ($consultas as $consulta): ?>
                                    <tr>
                                        <td class="consulta-nombre"><?= esc($consulta['nombre']) ?></td>
                                        <td><?= esc($consulta['email']) ?></td>
                                        <td><?= esc($consulta['asunto']) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-edit-custom" data-bs-toggle="modal" data-bs-target="#mensajeModal<?= $consulta['id'] ?>">
                                                <i class="fas fa-eye"></i> Ver
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
                                                            <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($consulta['created_at'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center" role="alert">
                        <i class="fas fa-info-circle"></i> No hay consultas registradas en este momento.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Búsqueda en tiempo real por nombre o email
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#consultasTable tr');
            rows.forEach(row => {
                let nombre = row.querySelector('.consulta-nombre').textContent.toLowerCase();
                let email = row.children[1].textContent.toLowerCase();
                row.style.display = (nombre.includes(filter) || email.includes(filter)) ? '' : 'none';
            });
        });
    </script>
</body>
</html>