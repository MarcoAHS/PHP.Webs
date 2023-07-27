<?php

use App\Propiedad;

define('TEMPLETES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');
function incluirTemplate( $nombre, $inicio = false){
    include TEMPLETES_URL . "/${nombre}.php";
}
function estaAutentificado() {
    session_start();
    if(!$_SESSION['login']){
        header('Location: /bienesraices/login.php');
    }
}
function debugear($variable){
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}
//Escapa el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
function mostrarNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1: 
            $mensaje = 'Propiedad Agregada Exitosamente';
            break;
        case 2: 
            $mensaje = 'Propiedad Actualizada Exitosamente';
            break;  
        case 3:
            $mensaje = 'Propiedad Eliminada Exitosamente';
            break;  
        case 4:
            $mensaje = 'Vendedor Agregado Exitosamente';
            break;  
        case 5: 
            $mensaje = 'Vendedor Actualizado Exitosamente';
            break;  
        case 6: 
            $mensaje = 'Vendedor Eliminado Exitosamente';
            break;    
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}