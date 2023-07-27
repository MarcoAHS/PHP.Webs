<?php 
    require '../../includes/app.php';
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
    estaAutentificado();

    $vendedores = Vendedor::all();


    $errores = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $propiedad = new Propiedad($_POST['propiedad']);
        //Generar id con Hash
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
        //Setear Imagen
        if($_FILES['propiedad']['tmp_name']['imagen']){
            //Realiza un resize a la imagen con Intervention
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }
        //Validar
        $propiedad->validar();
        $errores = $propiedad->getErrores();
        if(empty($errores)){
            //Subida de archivos
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            //Guardar la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            $resultado = $propiedad->guardar();
        if($resultado){
            header('Location: /bienesraices/admin/index.php?resultado=1');
        }
        }
    }
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a class="boton boton-verde" href="../index.php">Volver</a>
        <?php  foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>
        <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
        <?php 
            $u = 0;
            include '../../includes/templates/formulario_propiedades.php';
        ?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>
<?php 
    incluirTemplate('footer');
?>