<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
    require '../../includes/app.php';
    estaAutentificado();
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location: /bienesraices/admin/index.php');
    }
    //Consulta para llenar tabla Actualizar
    $propiedad = Propiedad::find($id);
    //Consulta para Opciones de Vendedores
    $vendedores_id = $propiedad->vendedores_id;
    $consulta = "SELECT * FROM vendedores WHERE id = ${vendedores_id}";
    $resultado = mysqli_query($db, $consulta);
    $vendedor = mysqli_fetch_assoc($resultado);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $resultado = $propiedad->borrar();
                if($resultado){
                    $propiedad->borrarImagen();
                    header('Location: /bienesraices/admin/index.php?resultado=3');
                }
    }
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Borrar</h1>
        <a class="boton boton-verde" href="../index.php">Volver</a>
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php 
                $u = 2;
                include '../../includes/templates/formulario_propiedades.php';
            ?>
            <input type="submit" value="Borrar Propiedad" class="boton boton-verde">
        </form>
    </main>
<?php 
    incluirTemplate('footer');
?>