<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu Plan</p>
    <div class="paquetes__grid">
        <div data-aos="<?php aos_animacion(); ?>" class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>
            <form action="finalizar-registro/gratis" method="POST">
                <input type="submit" class="paquete__submit" value="Inscripcion Gratis">
            </form>
        </div>
        <div data-aos="<?php aos_animacion(); ?>" class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 dias</li>
                <li class="paquete__elemento">Acceso a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a Grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>
            <p class="paquete__precio">$199</p>
            <form action="finalizar-registro/presencial" method="POST">
                <input type="submit" class="paquete__submit" value="Comprar Pase Presencial">
            </form>
        </div>
        <div data-aos="<?php aos_animacion(); ?>" class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 Dias</li>
                <li class="paquete__elemento">Acceso a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a Grabaciones</li>
            </ul>
            <p class="paquete__precio">$49</p>
            <form action="finalizar-registro/virtual" method="POST">
                <input type="submit" class="paquete__submit" value="Comprar Pase Virtual">
            </form>
        </div>
    </div>
</main>