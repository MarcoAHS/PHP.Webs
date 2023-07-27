<?php
namespace App;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validar(){
        //Errores
        if(!$this->nombre){
            self::$errores[] = "Debes completar el campo Nombre";
        }
        if(!$this->apellido){
            self::$errores[] = "Debes completar el campo Apellido";
        }
        if(!$this->telefono){
            self::$errores[] = "Debes completar el campo Telefono";
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato No Valido";
        }
    }
}