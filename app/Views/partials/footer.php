<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- hoja de estilo propio -->
    <link href="<?= base_url('assets/css/estilos-footer.css') ?>" rel="stylesheet">
    <!-- Font Awesome CSS (íconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
  </head>
  <body>
      <footer class="bg-light text-dark pt-5 pb-4">
        <div class="container text-center text-md-start">
          <div class="row text-center text-md-start mt-3">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Nosotros</h5>
                <hr class="mb-4">
                <p>
                  Somos una estetica dedicada a la venta de productos de cuidado y belleza,
                  con el objetivo de ofrecerte lo mejor en calidad y precio.
                </p>
              </div>
              
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Dejanos Ayudarte</h5>
                <hr class="mb-4">
                <p><a href="<?= base_url('carrito')?>" class="text-dark">Tus Órdenes</a></p>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Soporte</h5>
                <hr class="mb-4">
                <p><a href="<?= base_url("terminos_uso")?>" class="text-dark">Términos y Usos</a></p>
                <p><a href="<?= base_url("quienes_somos")?>" class="text-dark">Quiénes Somos</a></p>
                <p><a href="<?= base_url('informacion_contacto')?>" class="text-dark">Ayuda</a></p>
              </div>
              <!-- Sección: Contacto -->
              <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Contacto</h5>
                <hr class="mb-4">
                <a href="https://maps.app.goo.gl/AyygmzJQzbNx96HT8"><i class="fas fa-home me-3"></i>Riachuelo, Corrientes 3416</a>
                <p href="<?= base_url('informacion_contacto')?>"><i class="fas fa-envelope me-3"></i> belenjv123@gmail.com</p>
          
                <!-- 🔽 Botones de redes -->
                <div class="mt-4">
                  <a href="https://www.facebook.com/belen.vera.747606" target="_blank" class="me-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" width="30" style="vertical-align: middle;">
                  </a>

                  <a href="https://www.instagram.com/belenveraestilista/" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="30" style="vertical-align: middle;">
                  </a>
                </div>
              </div>

            </div> <!-- Cierre de row -->
        </div> <!-- Cierre de container -->
      </footer>

  </body>
</html>
