<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path){
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}

function auth() : bool{
    session_start();
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}
function admin() : bool{
    session_start();
    if($_SESSION['admin'] === "1") return true;
    else return false;
}
function aos_animacion() : void {
    $efectos = ['fade-up', 'fade-down', 'fade-left', 'fade-right'];
    $efecto = array_rand($efectos, 1);
    echo $efectos[$efecto];
}