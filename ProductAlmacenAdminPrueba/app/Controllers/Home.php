<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Home extends BaseController
{
    public function index(): string
    {
        $almacenes = ProductosModel::getAlmacenes();
        return view('welcome_message', ['almacenes' => $almacenes]);
    }
    public function consulta(){
        $result = ProductosModel::getProductosJoinAlmacen($_GET['limite'], $_GET['page'], $_GET['search']);
        return $result;
    }
    public function nuevo(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['precio'] < 0) return "El Precio debe ser Positivo";
            $result = ProductosModel::nuevo($_POST['name'], $_POST['precio'], $_POST['id_almacen']);
            if($result){
                echo "Agregado Correctamente";
            }
        }
    }
    public function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $result = ProductosModel::eliminar($_POST['id']);
            var_dump($result);
            if($result){
                echo "Producto Eliminado Con Exito";
            }
        }
    }
    public function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $result = ProductosModel::actualizar($_POST['id'], $_POST['name'], $_POST['precio'], $_POST['id_almacen']);
            if($result){
                echo "Actualizado Correctamente";
            }
        }
    }
    public function producto(){
        $result = ProductosModel::Producto($_GET['id']);
        if($result){
            echo json_encode($result);
        }
    }
    public function pagination(){
        $result = ProductosModel::pagination($_GET['page'], $_GET['limite'], $_GET['search']);
        if($result){
            return ($result);
        }
    }
}
