<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Entrada de Blog</h1>
        <div class="anuncio-">
            <picture>
                <source srcset="build/img/destacada3.webp" type="image/webp">
                <source srcset="build/img/destacada3.jpg" type="image/jpeg">
                <img src="build/img/destacada3.jpg" alt="blog" loading="lazy">
            </picture>
            <div class="texto-entrada">
                    <p>Escrito el: <span>13/02/2023</span> por: <span>Admin</span></p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
            </div>
            <div class="contenido-anuncio">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore aut corporis nostrum, adipisci tempore id, illo atque error ea similique facilis eveniet quibusdam praesentium voluptatibus, aperiam voluptate neque molestias aliquid?</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore aut corporis nostrum, adipisci tempore id, illo atque error ea similique facilis eveniet quibusdam praesentium voluptatibus, aperiam voluptate neque molestias aliquid?</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore aut corporis nostrum, adipisci tempore id, illo atque error ea similique facilis eveniet quibusdam praesentium voluptatibus, aperiam voluptate neque molestias aliquid?</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore aut corporis nostrum, adipisci tempore id, illo atque error ea similique facilis eveniet quibusdam praesentium voluptatibus, aperiam voluptate neque molestias aliquid?</p>
                <!-- <a href="anuncio.html" class="boton boton-amarillo">Ver propiedad</a> -->
            </div>
        </div>
    </main>
    <?php 
    incluirTemplate('footer');
?>