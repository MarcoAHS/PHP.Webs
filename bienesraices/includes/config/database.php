<?php 
function conectarDB() : mysqli {
    $db = new mysqli('localhost','root', 'root', 'bienesraices_crud');
    if(!$db){
        echo 'Error en Conneccion a la Base de Datos';
        exit;
    }
    return $db;
}