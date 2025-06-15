<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>B.V</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- link hoja de estilo propia -->
        <link href="<?= base_url('assets/css/estilos-principal.css') ?>" rel="stylesheet">
        <!-- link typografia -->
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Cedarville+Cursive&family=Great+Vibes&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
        
    <body>

        
        <header class="hero" id="inicio">
            <video autoplay muted loop class="background-video">
                <source src="/Proyecto_Estetica/public/assets/img/video-V-B.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>

            <div class="hero-text">
                <h1>Realza tu Belleza Natural</h1>
                <p>Tratamientos de calidad para tu cabello y estilo único.</p>
                <a href="<?= base_url("comercializacion")?>" class="btn-cta">Conocé nuestros servicios</a>
            </div>
        </header>

        <section class="presentacion">
            <div class="container">
                <h2>Sobre Nosotros</h2>
                <p>En nuestra Estética nos dedicamos a realzar tu belleza a través de tratamientos capilares, cortes, peinados, colorimetria, además de perfilados y laminados. También contamos con una exclusiva línea de productos para el cuidado de tu cabello.</p>
            </div>
        </section>

        <section class="servicios" id="servicios">
            <div class="container">
                <h2>Servicios</h2>
                <div class="servicios-grid">
                    <div class="servicio">
                        <h3>Tratamientos Capilares</h3>
                        <p>Recuperá la vitalidad de tu cabello con nuestros tratamientos profesionales.</p>
                    </div>
                    <div class="servicio">
                        <h3>Cortes, Color y Peinados</h3>
                        <p>Estilos modernos, Transformando tu look con tecnicas de color clásicas y personalizadas para cada ocasión.</p>
                    </div>
                    <div class="servicio">
                        <h3>Laminados y Perfilados</h3>
                        <p>Técnicas de laminado y técnicas perfilados con navajas e hilos únicas.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="productos" id="productos">
            <div class="container">
                <h2>Productos</h2>
                <p>Ofrecemos productos de alta calidad para el cuidado diario de tu cabello.</p>
            </div>
        </section>
        
        <a href="http://wa.me/5493794617433" class="whatsapp-button" target="_blank">
          <img src="/Proyecto_Estetica/public/assets/img/whatsapp.png" alt="Whatsapp" class="whatsapp-icon">
        </a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    </body>
</html>

