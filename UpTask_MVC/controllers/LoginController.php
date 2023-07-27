<?php 
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $usuario = new Usuario();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();
            if(empty($alertas)){
                $usuario = Usuario::where('email', $_POST['email']);
                if(!$usuario || !$usuario->confirmado){
                    $alertas['error'][] = 'El usuario no esta registrado o confirmado';
                } else {
                    if(password_verify($_POST['password'], $usuario->password)){
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        header('Location: /dashboard');
                    } else {
                        $alertas['error'][] = 'El Password es incorrecto';
                    }
                }
            }
        }
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }
    public static function logout(Router $router){
        session_start();
        $_SESSION = [];
        header('Location: /');
        $router->render('auth/logout', [
        ]);
    }
    public static function crear(Router $router){
        $usuario = new Usuario();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if(empty($alertas)){
                if(Usuario::where('email', $usuario->email)){
                    $alertas['error'][] = 'El usuario ya esta registrado';
                } else {
                    $usuario->hashPassword();
                    unset($usuario->password2);
                    $usuario->crearToken();                    
                    $resultado = $usuario->guardar();
                    if($resultado){                    
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function olvide(Router $router){
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where('email', $usuario->email);
                if($usuario){
                    if(!$usuario->confirmado){
                        $alertas['error'][] = "El usuario no esta confirmado";
                    } else {
                        $usuario->crearToken();
                        unset($usuario->password2);
                        $resultado = $usuario->guardar();
                        if($resultado){
                            $mail = new Email($usuario->email, $usuario->nombre, $usuario->token);
                            $mail->reestablecer();
                            header('Location: /mensaje');
                        }
                    }
                } else {
                    $alertas['error'][] = "El usuario no existe";
                }
            }
        }
        $router->render('auth/olvide', [
            'titulo' => 'Recuperar',
            'alertas' => $alertas
        ]);
    }
    public static function reestablecer(Router $router){
        $token = s($_GET['token']);
        if(!$token) header('Location: /');
        $usuario = Usuario::where('token', $token);
        if(!$usuario) header('Location: /');
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPasswordNueva();
            if(empty($alertas)){
                $usuario->hashPassword();
                unset($usuario->password2);
                $usuario->token = null;
                $usuario->guardar();
                $alertas['exito'][] = "Se reestablecio tu Password correctamente";
            }
        }
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer',
            'alertas' => $alertas
        ]);
    }
    public static function mensaje(Router $router){
        $router->render('auth/mensaje', [
            'titulo' => 'Instrucciones'
        ]);
    }
    public static function confirmar(Router $router){
        $alertas = [];
        if(!s($_GET['token'])){
            header('Location: /');
        }
        $usuario = Usuario::where('token', s($_GET['token']));
        if(empty($usuario)){
            $alertas['error'][] = 'El token no coincide';
        } else{
            $usuario->confirmado = 1;
            unset($usuario->password2);
            $usuario->token = null;
            $resultado = $usuario->guardar();
            if($resultado){
                $alertas['exito'][] = 'Se confirmo la cuenta correctamente';
            }
        }
        $router->render('auth/confirmar', [
            'titulo' => 'Cuenta Confirmada',
            'alertas' => $alertas
        ]);
    }
}