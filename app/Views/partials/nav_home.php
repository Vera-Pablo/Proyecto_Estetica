<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="<?= base_url('assets/css/estilos-navbar.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-hidden navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand ms-lg-5" href="<?= base_url("/")?>">
          <img src="<?= base_url('assets/img/VB.png') ?>">
        </a>
        
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Menú</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3 nav nav-underline">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url("/")?>">Página Principal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="<?= base_url("comercializacion")?>">Comercializacion</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="<?= base_url("catalogo")?>">Catálogo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="<?= base_url("quienes_somos")?>">¿Quienes Somos?</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="<?= base_url("consultas")?>">Consultas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="<?= base_url("informacion_contacto")?>">Contactos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="<?= base_url("terminos_uso")?>">Terminos y uso</a>
              </li>
              
              <hr class="d-lg-none"> <li class="nav-item d-lg-none">
                <a href="#" class="nav-link">Carrito</a>
              </li>
              <li class="nav-item d-lg-none">
                <a href="#" class="nav-link">Favoritos</a>
              </li>
              <?php if (session()->get('logueado')): ?>
                <?php if (session()->get('rol') === 'admin'): ?>
                  <li class="nav-item d-lg-none">
                    <a href="<?= base_url('panel_admin') ?>" class="nav-link">Panel Admin</a>
                  </li>
                <?php else: ?>
                  <li class="nav-item d-lg-none">
                    <a href="<?= base_url('panel') ?>" class="nav-link">Mi Perfil</a>
                  </li>
                <?php endif; ?>
              <?php else: ?>
                <li class="nav-item d-lg-none">
                    <a href="<?= base_url('login') ?>" class="nav-link">Iniciar Sesión</a>
                </li>
              <?php endif; ?>

            </ul>
          </div>
        </div>

        <div class="style-button d-none d-lg-flex align-items-center">
          <a href="#" class="carrito-button mx-1">
            <img src="<?= base_url('assets/img/carrito.png') ?>" alt="carrito">
          </a>
          <a href="#" class="favorite-button mx-1">
            <img src="<?= base_url('assets/img/favorito.png') ?>" alt="favorito">
          </a>
          <?php if (session()->get('logueado')): ?>
            <?php if (session()->get('rol') === 'admin'): ?>
              <a href="<?= base_url('panel_admin') ?>" class="login-button mx-1" title="Panel Admin">
                <img src="<?= base_url('assets/img/usuario.png') ?>" alt="admin">
              </a>
            <?php else: ?>
              <a href="<?= base_url('panel') ?>" class="login-button mx-1" title="Mi perfil">
                <img src="<?= base_url('assets/img/usuario.png') ?>" alt="perfil">
              </a>
            <?php endif; ?>
          <?php else: ?>
            <a href="<?= base_url('login') ?>" class="login-button mx-1" title="Iniciar sesión">
              <img src="<?= base_url('assets/img/usuario.png') ?>" alt="login">
            </a>
          <?php endif; ?>
        </div> 

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>