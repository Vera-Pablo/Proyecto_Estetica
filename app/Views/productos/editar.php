
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container gestion-container my-5">
        <div class="text-center mb-4">
            <h2 class="gestion-header" style="font-size:2.5rem;">
                <i class="fa fa-edit me-2 text-pink"></i>
                Editar Producto
            </h2>
            <p class="text-muted mb-0" style="font-size:1.1rem;">Modifica los datos del producto</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/productos/actualizar/' . $producto['id']) ?>" method="post" enctype="multipart/form-data" class="card p-4 shadow-sm border-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-medium">
                                <i class="fa fa-tag me-1 text-pink"></i> Nombre del producto
                            </label>
                            <input type="text" name="nombre" id="nombre" value="<?= esc($producto['nombre']) ?>" class="form-control pastel-input" required>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label fw-medium">
                                <i class="fa fa-list me-1 text-pink"></i> Categoría
                            </label>
                            <select name="categoria_id" id="categoria_id" class="form-select pastel-input" required>
                                <option value="">Seleccionar categoría</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $producto['categoria_id']) ? 'selected' : '' ?>>
                                        <?= esc($categoria['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="descripcion" class="form-label fw-medium">
                                <i class="fa fa-align-left me-1 text-pink"></i> Descripción
                            </label>
                            <textarea name="descripcion" id="descripcion" class="form-control pastel-input" rows="3" required><?= esc($producto['descripcion']) ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="precio" class="form-label fw-medium">
                                <i class="fa fa-dollar-sign me-1 text-pink"></i> Precio ($)
                            </label>
                            <input type="number" name="precio" id="precio" value="<?= esc($producto['precio']) ?>" class="form-control pastel-input" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label fw-medium">
                                <i class="fa fa-boxes-stacked me-1 text-pink"></i> Stock
                            </label>
                            <input type="number" name="stock" id="stock" value="<?= esc($producto['stock']) ?>" class="form-control pastel-input" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="fa fa-image me-1 text-pink"></i> Imagen actual
                            </label><br>
                            <img src="<?= base_url('assets/img/' . $producto['imagen']) ?>" width="120" class="mb-2 rounded shadow-sm">
                        </div>
                        <div class="col-md-6">
                            <label for="imagen" class="form-label fw-medium">
                                <i class="fa fa-upload me-1 text-pink"></i> Cambiar imagen (opcional)
                            </label>
                            <input type="file" name="imagen" id="imagen" class="form-control pastel-input" accept="image/*">
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-edit-custom me-2">
                            <i class="fa fa-save me-1"></i> Actualizar
                        </button>
                        <a href="<?= base_url('/index_producto') ?>" class="btn btn-secondary-custom">
                            <i class="fa fa-times me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .text-pink { color: #e09cb4 !important; }
        .pastel-input:focus {
            border-color: #e09cb4;
            box-shadow: 0 0 0 0.15rem rgba(224,156,180,0.25);
        }
        .pastel-input {
            background: #fff6fa;
            border-radius: 10px;
            border: 1px solid #f7c7db;
        }
        .fw-medium { font-weight: 500; }
    </style>
</body>
</html>