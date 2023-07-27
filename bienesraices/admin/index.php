<?php 
    require '../includes/app.php';
    estaAutentificado();
    use App\Propiedad;
    use App\Vendedor;
    
    //Propiedades Active Record
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    //Muestra mensaje condicional si se agrego propiedad
    $resultado = $_GET['resultado'] ?? null;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($resultado): ?>
            <p class="alerta exito"><?php echo s(mostrarNotificacion(intval($resultado))); ?></p>
        <?php endif; ?>
        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $propiedades as $propiedad ):?>
                <tr>
                    <td> <?php echo $propiedad->id; ?> </td>
                    <td> <?php echo $propiedad->titulo; ?> </td>
                    <td> <img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <a class="boton-amarillo" href="propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                        <a class="boton-rojo" href="propiedades/borrar.php?id=<?php echo $propiedad->id; ?>">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="boton boton-verde" href="propiedades/crear.php">Nueva Propiedad</a>
        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $vendedores as $vendedor ):?>
                <tr>
                    <td> <?php echo $vendedor->id; ?> </td>
                    <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?> </td>
                    <td> #<?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a class="boton-amarillo" href="vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                        <a class="boton-rojo" href="vendedores/borrar.php?id=<?php echo $vendedor->id; ?>">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="boton boton-verde" href="vendedores/crear.php">Nuevo Vendedor</a>
    </main>
<?php
    incluirTemplate('footer');
?>