<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Cines Moreno - Sobre Nosotros</title>
        <link rel="stylesheet" href="estilo.css">
        <!--Adapta la web al ancho del dispositivo y el zoom-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header>
            <?php include("header.php"); ?>
        </header>

        <main>
            <section class="caja_info">
                <article>
                    <h2>Sobre Nosotros</h2>
                    <p>
                        En Cines Moreno, estamos comprometidos en brindar a los espectadores una experiencia 
                        cinematográfica única e inolvidable. Nos apasiona el cine como arte y forma de expresión, 
                        y queremos compartir esa pasión con nuestros clientes. Para ello, nuestros cines cuentan 
                        con avanzadas tecnologías de proyección y sonido, butacas cómodas y espaciosas y una amplia 
                        oferta de snacks y bebidas, para que disfrutes del cine como si estuvieras en casa. Además, 
                        nuestro ambiente acogedor te permitirá disfrutar de la magia del cine con los tuyos. 
                        ¡Ven a Cines Moreno a vivir una experiencia cinematográfica como nunca antes!
                    </p>
                </article>

                <article>
                    <h2>Dónde Estamos</h2>
                    <!-- Inserto un Mapa de Google con la Ubicacion del cine -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12712.801418078932!2d-3.6190105595703126!3d37.19547036020044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71fc55025f928b%3A0x4dbbca09efdcad08!2sE.T.S.%20de%20Ingenier%C3%ADas%20Inform%C3%A1tica%20y%20de%20Telecomunicaci%C3%B3n!5e0!3m2!1ses!2ses!4v1680126593673!5m2!1ses!2ses" 
                       loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </article>
            </section>

            <a href="#" class="boton-flotante"></a>
        </main>

        <footer>
        <?php include("footer.html"); ?>
        </footer>
    </body>
</html>