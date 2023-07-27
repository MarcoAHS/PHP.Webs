<?php
namespace App;
class ActiveRecord{
    //BD
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores
    protected static $errores = [];


    public static function setDB($database){
        self::$db = $database;
    }
    public function guardar(){
        if(!is_null($this->id)){
            return $this->actualizar();
        } else{
            return $this->crear();
        }
    }
    public function crear(){
        //Sanitizar los datos
        $atributos = $this->sanitizar();
        //SQL
        $query = "INSERT INTO " . static::$tabla . " ( " . join(', ', array_keys($atributos)) . " ) 
        VALUES ( '" . join("', '", array_values($atributos)) . "' )";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizar();
        //Estructurarlos para el query
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key} = '{$value}'";
        }
        //SQL
        $query = "UPDATE " . static::$tabla ." SET " . join(', ', $valores) . " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public function borrar(){
        $query = "DELETE FROM " . static::$tabla ." WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    //Subida de Archivos
    public function setImagen($imagen){
        //Eliminar la anterior
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //Asignar Imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }
    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    public function sanitizar(){
        $atributos = $this->atributos();
        $sanitizados = [];
        foreach($atributos as $key => $value){
            $sanitizados[$key] = self::$db->escape_string($value);
        }
        return $sanitizados;
    }
    //Validacion
    public function validar(){
        
    }
    public static function getErrores(){
        return static::$errores;
    }
    public static function all($limite = null){
        $query = "SELECT * FROM " . static::$tabla;
        if(!is_null($limite)){
            $query .= " LIMIT " . $limite;
        }
        return self::consultarSQL($query);
    }
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla ." WHERE id = ${id}";
        return array_shift( self::consultarSQL($query));
    }
    public static function consultarSQL($query){
        $resultado = self::$db->query($query);
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }
    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}