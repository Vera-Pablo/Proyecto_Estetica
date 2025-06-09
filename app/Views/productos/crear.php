<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Agregar Producto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-principal.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
        
    <body>
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Nuevo Producto</h2>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('/productos/guardar') ?>" method="post" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-select" required>
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

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio ($)</label>
                    <input type="number" name="precio" id="precio" class="form-control" step="0.01" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" step="0.01" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Arrastre la imagen aquí</label>
                    <input type="file" name="imagen_file" id="imagen_file" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="nombre_imagen" class="form-label">Nombre del archivo de imagen</label>
                    <input type="text" name="nombre_imagen" id="nombre_imagen" class="form-control" readonly>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Guardar producto</button>
                    <a href="<?= base_url('/productos') ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
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