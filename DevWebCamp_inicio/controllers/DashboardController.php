<?php 
namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        $registros = Registro::get(5);
        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
        }
        $virtuales = Registro::total('paquete_id', 2);
        $precensial = Registro::total('paquete_id', 1);
        $ingresos = ($virtuales * 46.41) + ($precensial * 189.54);
        $menos = Evento::ordenarLimite('disponibles', 'ASC', 5);
        $mas = Evento::ordenarLimite('disponibles', 'DESC', 5);
        $router->render('admin/dashboard/index',[
            'titulo' => 'Panel',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos' => $menos,
            'mas' => $mas
        ]);
    }
}