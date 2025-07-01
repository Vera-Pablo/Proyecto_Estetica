<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos-gestion.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container gestion-container my-5">
        <div class="text-center mb-4">
            <h2 class="gestion-header" style="font-size:2.5rem;">
                <i class="fa fa-plus-circle me-2 text-pink"></i>
                Nuevo Producto
            </h2>
            <p class="text-muted mb-0" style="font-size:1.1rem;">Completa los datos para agregar un nuevo producto</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/productos/guardar') ?>" method="post" enctype="multipart/form-data" class="card p-4 shadow-sm border-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-medium">
                                <i class="fa fa-tag me-1 text-pink"></i> Nombre del producto
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control pastel-input" required>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label fw-medium">
                                <i class="fa fa-list me-1 text-pink"></i> Categoría
                            </label>
                            <select name="categoria_id" id="categoria_id" class="form-select pastel-input" required>
                                <option value="">Seleccionar categoría</option>
                                <?php if(!empty($categorias)): ?>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>"><?= esc($categoria['nombre']) ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay categorías disponibles</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="descripcion" class="form-label fw-medium">
                                <i class="fa fa-align-left me-1 text-pink"></i> Descripción
                            </label>
                            <textarea name="descripcion" id="descripcion" class="form-control pastel-input" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="precio" class="form-label fw-medium">
                                <i class="fa fa-dollar-sign me-1 text-pink"></i> Precio ($)
                            </label>
                            <input type="number" name="precio" id="precio" class="form-control pastel-input" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label fw-medium">
                                <i class="fa fa-boxes-stacked me-1 text-pink"></i> Stock
                            </label>
                            <input type="number" name="stock" id="stock" class="form-control pastel-input" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="imagen_file" class="form-label fw-medium">
                                <i class="fa fa-image me-1 text-pink"></i> Imagen del producto
                            </label>
                            <input type="file" name="imagen_file" id="imagen_file" class="form-control pastel-input" accept="image/*" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_imagen" class="form-label fw-medium">
                                <i class="fa fa-file-signature me-1 text-pink"></i> Nombre del archivo de imagen
                            </label>
                            <input type="text" name="nombre_imagen" id="nombre_imagen" class="form-control pastel-input" readonly>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-cta-gestion me-2">
                            <i class="fa fa-save me-1"></i> Guardar producto
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
    <script>
        document.getElementById('imagen_file').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                document.getElementById('nombre_imagen').value = e.target.files[0].name;
            } else {
                document.getElementById('nombre_imagen').value = '';
            }
        });
    </script>
</body>
</html>