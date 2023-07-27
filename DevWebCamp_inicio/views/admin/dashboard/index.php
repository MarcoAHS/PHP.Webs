<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Ultimos Registros</h3>
            <?php foreach($registros as $registro){ ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto"><?php echo $registro->usuario->nombre . ' ' . $registro->usuario->apellido; ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Total de Ingresos</h3>
            <div class="bloque__contenido">
                <p class="bloque__texto bloque__texto--ingresos"><?php echo $ingresos;?></p>
            </div>  
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Eventos con Menos Lugares Disponibles</h3>
            <?php foreach($menos as $m){ ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto"><?php echo $m->nombre . ' - ' . $m->disponibles . ' Disponibles';?></p>
                </div> 
            <?php } ?> 
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Eventos con Mas Lugares Disponibles</h3>
            <?php foreach($mas as $m){ ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto"><?php echo $m->nombre . ' - ' . $m->disponibles . ' Disponibles';?></p>
                </div> 
            <?php } ?> 
        </div>
    </div>
</main>