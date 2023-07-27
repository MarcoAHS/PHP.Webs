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
    $vendedor->sincronizar($_POST['vendedor']);
    $vendedor->validar();
    $errores = Vendedor::getErrores();
    if(empty($errores)){
        $resultado = $vendedor->guardar();
        if($resultado){
            header('Location: /bienesraices/admin/index.php?resultado=5');
        }
    }
}
incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Modificar Vendedores</h1>
        <a class="boton boton-verde" href="../index.php">Volver</a>
        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>
        <form class="formulario" method="POST">
        <?php 
            $u = 0;
            include '../../includes/templates/formulario_vendedores.php';
        ?>
            <input type="submit" value="Modificar Vendedor" class="boton boton-verde">
        </form>
    </main>
<?php
    incluirTemplate('footer');
?>