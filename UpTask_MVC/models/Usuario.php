<?php
namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $passwordA;
    public $passwordN;
    public $token;
    public $confirmado;
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? ''; 
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? null;  
        $this->token = $args['token'] ?? ''; 
        $this->confirmado = $args['confirmado'] ?? 0;         
    }
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del Usuario es Obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email del Usuario es Obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'El password del Usuario es Obligatorio';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe ser minimo de 6 caracteres';
        }
        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Los passwords no coinciden';
        }
        return self::$alertas;
    }
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = 'El email del Usuario es Obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'El password del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El email no es valido';
        }
        return self::$alertas;
    }
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El email no es valido';
        }
        return self::$alertas;
    }
    public function validarPasswordNueva(){
        if(!$this->password){
            self::$alertas['error'][] = 'El password del Usuario es Obligatorio';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe ser minimo de 6 caracteres';
        }
        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Los passwords no coinciden';
        }
        return self::$alertas;
    }
    public function validarPerfil(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del Usuario es Obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email del Usuario es Obligatorio';
        }
        return self::$alertas;
    }
    public function nuevoPassword(){
        if(!$this->passwordA){
            self::$alertas['error'][] = 'El password actual no puede ir Vacio';
        }
        if(!$this->passwordN){
            self::$alertas['error'][] = 'El password nuevo no puede ir Vacio';
        }
        if(strlen($this->passwordN) < 6){
            self::$alertas['error'][] = 'El password nuevo debe ser minimo de 6 caracteres';
        }
        return self::$alertas;
    }
    public function comprobarPassword(){
        return password_verify($this->passwordA, $this->password);
    }
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token = uniqid();
    }
}