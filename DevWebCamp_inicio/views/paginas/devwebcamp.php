<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__descripcion">Conoce la Conferencia mas Importante de Latinoamerica</p>
    <div class="devwebcamp__grid">
        <div data-aos="<?php aos_animacion(); ?>" class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/sobre_devwebcamp.jpg" alt="Imagen DevWebCamp">
            </picture>
        </div>
        <div data-aos="<?php aos_animacion(); ?>" class="devwebcamp__contenido">
            <p class="devwebcamp__texto">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum dolorem consectetur non mollitia! Fuga sed repudiandae iusto, alias commodi deleniti distinctio at itaque! Repellat vel sunt numquam. Cum, debitis accusantium.</p>
            <p class="devwebcamp__texto">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum dolorem consectetur non mollitia! Fuga sed repudiandae iusto, alias commodi deleniti distinctio at itaque! Repellat vel sunt numquam. Cum, debitis accusantium.</p>
        </div>
    </div>
</main>