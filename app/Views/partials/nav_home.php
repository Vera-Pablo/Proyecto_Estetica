<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- hoja de estilo propio -->
    <link href="<?= base_url('assets/css/estilos-navbar.css') ?>" rel="stylesheet">
    <!-- link of google font -->
    <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  </head>
  
  <body>
        <!-- Navbar -->
        <nav class="navbar navbar-hidden navbar-expand-lg">
          <div class="container-fluid">
            <!-- logo/nombre -->
            <a class="navbar-brand ms-lg-5" href="<?= base_url("/")?>">
              <img src="/Proyecto_Estetica/public/assets/img/VB.png">
            </a>
            <!-- end logo/name -->
            <!-- boton hamburguesa -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <!-- botones AGREGAR ENLACES DE OTRAS PAGINAS PHP-->
              <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3 nav nav-underline">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url("/")?>">Página Principal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="<?= base_url("comercializacion")?>">Comercializacion</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="<?= base_url("quienes_somos")?>">¿Quienes Somos?</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="<?= base_url("informacion_contacto")?>">Contactos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="<?= base_url("terminos_uso")?>">Terminos y uso</a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- botones carrito - favorito - usuario
            <div class="style-button ">
              <a href="#" class="carrito-button mx-1">
                <img src="/Proyecto_Estetica/public/assets/img/carrito.png" alt="carrito">
              </a>
              <a href="#" class="favorite-button mx-1">
                <img src="/Proyecto_Estetica/public/assets/img/favorito.png" alt="favorito">
              </a>
              <a href="#" class="login-button mx-1">
                <img src="/Proyecto_Estetica/public/assets/img/usuario.png" alt="usuario">
              </a>
            </div> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </nav>
        <!-- end navbar-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
