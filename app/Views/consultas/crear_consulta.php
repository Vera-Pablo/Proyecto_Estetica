<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envíanos tu Consulta - Estética</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/estilos-consultas.css') ?>">
</head>
<body>
    <div class="card">
        <div class="card-body p-4 p-md-5">
            <h2 class="card-header mb-4">Envíanos tu Consulta</h2>

            
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

            <form action="<?= base_url('consultas/guardar') ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?= old('nombre') ?: session('nombre') ?>" placeholder="Tu Nombre">
                </div>
                
                <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>                    
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= old('email') ?: session('email') ?>" placeholder="Ingrese tu correo electrónico">
                <div>

                
                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" value="<?= old('asunto') ?>" placeholder="Escribe el asunto de tu consulta">
                    <?php if ($validation->hasError('asunto')): ?>
                        <div class="text-danger mt-1"><?= $validation->getError('asunto') ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu consulta aquí..."><?= old('mensaje') ?></textarea>
                    <?php if ($validation->hasError('mensaje')): ?>
                        <div class="text-danger mt-1"><?= $validation->getError('mensaje') ?></div>
                    <?php endif; ?>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Enviar Consulta</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">
                    Volver a la página principal
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 