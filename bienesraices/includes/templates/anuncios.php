<?php 
    use App\Propiedad;
    $propiedades = Propiedad::all($limite);
?>

<div class="contenedor-anuncios">
        <?php foreach($propiedades as $propiedad): ?>
            <div class="anuncio">
                <img src="imagenes/<?php echo $propiedad->imagen ?>" alt="anuncio" loading="lazy">
                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad->titulo; ?></h3>
                    <p><?php echo $propiedad->descripcion; ?></p>
                    <p class="precio"><?php echo $propiedad->precio; ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="iconoInv" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad->wc; ?></p>
                        </li>
                        <li>
                            <img class="iconoInv" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad->estacionamiento; ?></p>
                        </li>
                        <li>
                            <img class="iconoInv" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                            <p><?php echo $propiedad->habitaciones; ?></p>
                        </li>
                    </ul>
                    <a href="anuncio.php?id= <?php echo $propiedad->id; ?>" class="boton boton-amarillo">Ver propiedad</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
<?php mysqli_close($db); ?>