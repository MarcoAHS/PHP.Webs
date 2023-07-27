<?php 
namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        session_start();
        isAuth();
        $proyectos = Proyecto::whereAll('propietarioId', $_SESSION['id']);
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }
    public static function crear_proyecto(Router $router){
        session_start();
        isAuth();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validar();
            if(empty($alertas)){
                $proyecto->propietarioId = $_SESSION['id'];
                $proyecto->url = md5(uniqid());
                $resultado = $proyecto->guardar();
                if($resultado){
                    header('Location: /proyecto?id=' . $proyecto->url);
                }
            }
        }
        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }
    public static function perfil(Router $router){
        session_start();
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($usuario->nombre === $_POST['nombre']){
                $alertas['error'][] = 'No se ha detectado un cambio';
            } else{
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarPerfil();
                if(empty($alertas)){
                    $existe = Usuario::where('email', $usuario->email);
                    if($existe && $existe->id !== $_SESSION['id']){
                        $alertas['error'][] = 'Email Ocupado';
                    } else {
                        $resultado = $usuario->guardar();
                        if($resultado){
                            $_SESSION['nombre'] = $usuario->nombre;
                            header('Location: /dashboard');
                        }
                    }
                }
            }
        }
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function proyecto(Router $router){
        session_start();
        isAuth();
        $proyecto = Proyecto::where('url', $_GET['id']);
        if(!$proyecto->id) header('Location: /dashboard');
        if($proyecto->propietarioId !== $_SESSION['id']){
            header('Location: /dashboard');
        } else {

        }
        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto,
            'proyectos' => $proyecto
        ]);
    }
    public static function cambiar_password(Router $router){
        session_start();
        isAuth();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = Usuario::find($_SESSION['id']);
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevoPassword();
            if(empty($alertas)){
                $resultado = $usuario->comprobarPassword();
                if($resultado){
                    $usuario->password = $usuario->passwordN;
                    unset($usuario->passwordN);
                    unset($usuario->passwordA);
                    $usuario->hashPassword();
                    $resultado = $usuario->guardar();
                    if($resultado){
                        $alertas['exito'][] = 'Password Actualizado Correctamente'; 
                    }
                } else{
                    $alertas['error'][] = 'Password Incorrecto';
                }
            }
        }
        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar Password',
            'alertas' => $alertas
        ]);
    }
}