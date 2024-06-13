<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use PHPUnit\Event\Telemetry\StopWatch;

class Home extends BaseController
{
    public function index(): string
    {
        if(!session()->get('name')){
            echo "<script>window.location = 'login';</script>";
        }
        return view('admin', ['nombre' => session()->get('name')]);
    }
    public function default(): string
    {
        if(!session()->get('name')){
            echo "<script>window.location = 'login';</script>";
        }
        return view('default', ['nombre' => session()->get('name')]);
    }
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = ProductosModel::auth($_POST['email']);
            if(!$result){
                echo "<script>window.location = 'login?flag=1';</script>";
            }else{
            if(password_verify($_POST['password'], $result->password)) {
                session()->set('name', $result->name);
                session()->set('email', $result->email);
                session()->set('type', $result->user_type);
                if($result->user_type == 1){
                    echo "<script>window.location = '/public';</script>";
                }else {
                    echo "<script>window.location = 'index';</script>";
                }
            } else {
                echo "<script>window.location = 'login?flag=2';</script>";
            }
        }
        }
        return view('login', []);
    }
    public function logout(){
        session()->set('name', '');
        session()->set('email', '');
        session()->set('type', '');
        echo "<script>window.location = 'login';</script>";
    }
    public function consulta(){
        $result = ProductosModel::getUsersJoinUserTypes($_GET['limite'], $_GET['page'], $_GET['search']);
        return $result;
    }
    public function nuevo(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['name'] == null) return "El nombre no puede estar vacio";
            if($_POST['phone'] < 10) return "Telefono incompleto, debe tener almenos 10 numeros";
            if($_POST['email'] == null) return "El Correo no puede estar vacio";
            if($_POST['password'] == null) return "La contrasena no puede estar vacia";
            if($_POST['date'] == null) return "La fecha de nacimiento no puede ser vacia";
            if($_POST['rfc'] == null) return "El RFC no puede estar vacio";
            $result = ProductosModel::nuevo([$_POST['name'], $_POST['phone'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['date'], $_POST['rfc'], $_POST['type']]);
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
            if($_POST['name'] == null) return "El nombre no puede estar vacio";
            if($_POST['phone'] < 10) return "Telefono incompleto, debe tener almenos 10 numeros";
            if($_POST['email'] == null) return "El Correo no puede estar vacio";
            if($_POST['password'] == null) return "La contrasena no puede estar vacia";
            if($_POST['date'] == null) return "La fecha de nacimiento no puede ser vacia";
            if($_POST['rfc'] == null) return "El RFC no puede estar vacio";
            $result = ProductosModel::actualizar([$_POST['id'], $_POST['name'], $_POST['phone'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['date'], $_POST['rfc'], $_POST['type']]);
            if($result){
                echo "Actualizado Correctamente";
            }
        }
    }
    public function userInfo(){
        $result = ProductosModel::userInfo($_GET['id']);
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
