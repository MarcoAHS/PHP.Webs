<?php
namespace App;

use GuzzleHttp\Psr7\Query;
use mysqli;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','estacionamiento','wc','creado','vendedores_id'];
    //Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $estacionamiento;
    public $wc;
    public $creado;
    public $vendedores_id;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }
    public function validar(){
        //Errores
        if(!$this->titulo){
            self::$errores[] = "Debes completar el campo Titulo";
        }
        if(!$this->precio){
            self::$errores[] = "Debes completar el campo precio";
        }
        if(strlen($this->descripcion) < 20){
            self::$errores[] = "Debes completar el campo descripcion y contener al menos 20 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "Debes completar el campo habitaciones";
        }
        if(!$this->wc){
            self::$errores[] = "Debes completar el campo wc";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "Debes completar el campo estacionamiento";
        }
        if(!$this->vendedores_id){
            self::$errores[] = "Debes completar el campo vendedor";
        }
        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }
    }
}