<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <title>Información de Contacto</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?= base_url('assets/css/estilos-informacionContacto.css') ?>" rel="stylesheet">
  </head>

  <body>

    <div class="container my-5">
      <h1 class="text-center mb-4">Información de Contacto</h1>

      <div class="row">
        <div class="col-md-6 mb-4">
          <h5>Nombre del titular:</h5>
          <p>Vera Juliana Belén</p>

          <h5>Razón social:</h5>
          <p>Estética V-B</p>

          <h5>Domicilio legal:</h5>
          <p>Ernesto Lencina 57 , Riachuelo - Corrientes Argentina</p>

          <h5>Teléfono:</h5>
          <p>+54 3794 617433</p>

          <h5>Email:</h5>
          <p>belenjv123@gmail.com</p>
        </div>

        <div class="col-md-6">
          <h5>¿Querés comunicarte con nosotros?</h5>
          <form method="post" action="#">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre y Apellido</label>
              <input type="text" class="form-control" id="nombre" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea class="form-control" id="mensaje" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar consulta</button>
          </form>
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>

