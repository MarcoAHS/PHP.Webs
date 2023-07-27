<?php 
    require 'includes/app.php';
    $id = $_GET['id'] ?? null;
    if(!$id){
        header('Location: /bienesraices/index.php');
    }
    //Importar la conexion
    use App\Propiedad;
    //Escribir el Query
    $propiedad = Propiedad::find($id);
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>
        <div class="anuncio">
            <img src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio" loading="lazy">
            <p class="precio"><?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas iconos-individual">
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
            <div class="contenido-anuncio">
                <p><?php echo $propiedad->descripcion; ?></p>
            </div>
        </div>
    </main>
    <?php 
    incluirTemplate('footer');
    ?>