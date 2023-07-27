<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
    require '../../includes/app.php';
    estaAutentificado();
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location: /bienesraices/admin/index.php');
    }
    //Consulta para llenar tabla Propiedad y Vendedores
    $propiedad = Propiedad::find($id);
    $vendedores = Vendedor::all();
    $errores = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
        if($_FILES['propiedad']['tmp_name']['imagen']){
            //Realiza un resize a la imagen con Intervention
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            //Guardar la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            $propiedad->borrarImagen();
            $propiedad->setImagen($nombreImagen);
        }
        //Errores
        $propiedad->validar();
        $errores = $propiedad::getErrores();
        if(empty($errores)){
            //Subida de archivos
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
                $resultado = $propiedad->guardar();

                if($resultado){
                    header('Location: /bienesraices/admin/index.php?resultado=2');
                }            
            }
    }
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar</h1>
        <a class="boton boton-verde" href="../index.php">Volver</a>
        <?php  foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php 
                $u = 1;
                include '../../includes/templates/formulario_propiedades.php';
            ?>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>
<?php 
    incluirTemplate('footer');
?>