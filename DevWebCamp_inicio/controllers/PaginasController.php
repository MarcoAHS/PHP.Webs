<?php 
namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class PaginasController{
    public static function index(Router $router){
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
        $ponentes_total = Ponente::total();
        $conferencias_total = Evento::total('categoria_id', 1);
        $workshops_total = Evento::total('categoria_id', 2);

        $ponentes = Ponente::all();
        $router->render('/paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $formateados,
            'ponentes_total' => $ponentes_total,
            'conferencias_total' => $conferencias_total,
            'workshops_total' => $workshops_total,
            'ponentes' => $ponentes
        ]);
    }
    public static function evento(Router $router){
        $router->render('/paginas/devwebcamp', [
            'titulo' => 'Sobre DevWebCamp'
        ]);
    }
    public static function error(Router $router){
        $router->render('/paginas/404', [
            'titulo' => 'Pagina No Encontrada / Error 404'
        ]);
    }
    public static function paquetes(Router $router){
        $router->render('/paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }
    public static function conferencias(Router $router){
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
        $router->render('/paginas/conferencias', [
            'titulo' => 'Conferencias & WorkShops',
            'eventos' => $formateados
        ]);
    }
}