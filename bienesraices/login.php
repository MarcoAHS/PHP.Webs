<?php 
    require 'includes/app.php';
    $db = conectarDB();
    $errores = [];
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $email = mysqli_real_escape_string($db,  filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password = mysqli_real_escape_string($db, $_POST['password']);
        if(!$email){
            $errores[] = "El email es obligatorio";
        }
        if(!$password){
            $errores[] = "El password es obligatorio";
        }
        if(empty($error)){
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($db, $query);
            if($resultado->num_rows){
                $usuario = mysqli_fetch_assoc($resultado);
                //Verificar si el passsword es correcto
                $auth = password_verify($password, $usuario['password']);
                if($auth){
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    header('Location: /bienesraices/admin/index.php');
                }else{
                    $errores[] = 'El password es Incorrecto';
                }
            }else{
                $errores[] = "Resultado no Existe";
            }
        }
    }
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>
                <label for="email">Email</label>
                <input id="email" type="email" placeholder="Tu Email" name="email" required>

                <label for="password">Password</label>
                <input type="password" placeholder="Tu Password" id="password" name="password" required>
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>
<?php 
    incluirTemplate('footer');
?>