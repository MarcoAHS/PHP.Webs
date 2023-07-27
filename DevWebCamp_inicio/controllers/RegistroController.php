<?php 
namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\EventosRegistros;
use Model\Hora;
use Model\Paquete;
use Model\Ponente;
use Model\Regalo;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistroController{
    public static function crear(Router $router){
        if(!auth()){
            header('Location: /');
            return;
        }
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        if(isset($registro) && ($registro->paquete_id === "3" || $registro->paquete_id === "2")){
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }
        if(isset($registro) && $registro->paquete_id === "1"){
            header('Location: /finalizar-registro/conferencias');
            return;
        }
        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }
    public static function gratis(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!auth()){
                header('Location: /login');
                return;
            }
            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos = array(
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );
            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            if($resultado){
                header('Location: /finalizar-registro');
            }
        }
    }
    public static function virtual(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!auth()){
                header('Location: /login');
            }
            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos = [
                'paquete_id' => 2,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ];
            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            if($resultado){
                header('Location: /finalizar-registro');
            }
        }
    }
    public static function presencial(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!auth()){
                header('Location: /login');
            }
            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos = [
                'paquete_id' => 1,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ];
            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            if($resultado){
                header('Location: /finalizar-registro/conferencias');
            }
        }
    }
    public static function boleto(Router $router){
        $id = $_GET['id'];
        if(!$id || strlen($id) !== 8){
            header('Location: /');
        }
        $registro = Registro::where('token', $id);
        if(!$registro){
            header('Location: /');
        }
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);
        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }
    public static function conferencias(Router $router){
        if(!auth()){
            header('Location: /login');
        }
        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);
        if($registro->paquete_id !== '1'){
            header('Location: /');
        }
        $eventosRegistro = EventosRegistros::where('registro_id', $registro->id);
        if(isset($eventosRegistro)){
            header('Location: /boleto?id=' . urlencode($registro->token));
        }
        $eventos = Evento::ordenar('hora_id', 'ASC');
        $formateados = [];
        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id)->nombre;
            $evento->dia = Dia::find($evento->dia_id)->nombre;
            $evento->hora = Hora::find($evento->hora_id)->hora;
            $evento->ponente = Ponente::find($evento->ponente_id);
            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $formateados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $formateados['conferencias_s'][] = $evento;
            }
            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $formateados['workshops_v'][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $formateados['workshops_s'][] = $evento;
            }
        }
        $regalos = Regalo::all('ASC');
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!auth()){
                header('Location: /login');
            }
            $eventos = explode(',', $_POST['eventos']);
            if(empty($evento)){
                echo json_encode(['resultado' => false]);
                return;
            }
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(!isset($registro) || $registro->paquete_id !== "1"){
                echo json_encode(['resultado' => false]);
                return;
            }
            //Validar Disponibilidad
            $eventos_array = [];
            foreach($eventos as $e){
                $evento = Evento::find($e);
                if(!isset($evento) || $evento->disponibles === "0"){
                    echo json_encode(['resultado' => false]);
                    return;
                }
                $eventos_array[] = $evento;
            }
            foreach($eventos_array as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();
                //Almacena el Registro
                $datos = [
                    'evento_id' => (int) $evento->id,
                    'registro_id' => (int) $registro->id
                ];
                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }
            $registro->sincronizar(['regalo_id' => $_POST['regalo_id']]);
            $resultado = $registro->guardar();
            if($resultado){
                echo json_encode([ 
                    'resultado' => $resultado,
                    'token' => $registro->token]);
            } else{
                echo json_encode(['resultado' => false]);
            }
            return;
        }
        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $formateados,
            'regalos' => $regalos
        ]);
    }
}