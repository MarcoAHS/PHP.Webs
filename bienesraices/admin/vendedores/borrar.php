<?php 
require '../../includes/app.php';
use App\Vendedor;
estaAutentificado();
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
    header('Location: /bienesraices/admin/index.php');
}
$vendedor = Vendedor::find($id);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $resultado = $vendedor->borrar();
    if($resultado){
        header('Location: /bienesraices/admin/index.php?resultado=6');
    }
}
incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Eliminar Vendedores</h1>
        <a class="boton boton-verde" href="../index.php">Volver</a>
        <form class="formulario" method="POST">
        <?php 
            $u = 2;
            include '../../includes/templates/formulario_vendedores.php';
        ?>
            <input type="submit" value="Eliminar Vendedor" class="boton boton-verde">
        </form>
    </main>
<?php
    incluirTemplate('footer');
?>