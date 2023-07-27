<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen Blog 1">
                </picture>
            </div>
            <div class="nosotros-texto">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima voluptas ipsa ullam autem delectus nisi aliquid! Nesciunt autem dolore eum ullam amet nihil, architecto aliquam veniam, ex fuga libero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima voluptas ipsa ullam autem delectus nisi aliquid! Nesciunt autem dolore eum ullam amet nihil, architecto aliquam veniam, ex fuga libero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima voluptas ipsa ullam autem delectus nisi aliquid! Nesciunt autem dolore eum ullam amet nihil, architecto aliquam veniam, ex fuga libero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima voluptas ipsa ullam autem delectus nisi aliquid! Nesciunt autem dolore eum ullam amet nihil, architecto aliquam veniam, ex fuga libero?
                </p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque quibusdam commodi quia porro optio, repellendus eius officia blanditiis incidunt omnis obcaecati excepturi velit? Laudantium, tenetur ad. Quaerat quos optio autem.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque quibusdam commodi quia porro optio, repellendus eius officia blanditiis incidunt omnis obcaecati excepturi velit? Laudantium, tenetur ad. Quaerat quos optio autem.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque quibusdam commodi quia porro optio, repellendus eius officia blanditiis incidunt omnis obcaecati excepturi velit? Laudantium, tenetur ad. Quaerat quos optio autem.</p>
            </div>
        </div>
    </section>
    <?php 
    incluirTemplate('footer');
?>