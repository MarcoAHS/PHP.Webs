<?php 
namespace App\Models;

use CodeIgniter\CLI\Console;
use CodeIgniter\Model;
use Faker\Core\Number;

class ProductosModel extends Model{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'name', 'phone', 'email', 'password', 'born_date', 'RFC', 'user_type', 'active'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    public static function getEmpleados(){
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM users WHERE active = 1";
        $query = $db->query($sql);
        $results = $query->getResult();
        return $results;
    }
    public static function getUsersJoinUserTypes($limite, $page, $search){
        if($page){
            $inicio = ($page - 1) * $limite;
        } else{
            $inicio = 0;
            $page = 1;
        }
        $db = \Config\Database::connect();
        $sql = "CALL getUsersJoinUserTypes(". $inicio . ", " . $limite .", '%" . $search . "%');";
        $query = $db->query($sql);
        $results = $query->getResult();
        $html = '';
        foreach($results as $result){
            $html .= "<tr>";
            foreach($result as $key => $value){    
                $html .= "<td>" . $value . "</td>";
            }
            $html .= "<td>";
            $html .= "<button class='editarModal' onclick='userInfo(" . $result->id . ")'>Editar</button>";
            $html .= "<button onclick='eliminarUsuario(" . $result->id . ")'>Elimanar</button>";
            $html .= "</td>";
            $html .= "</tr>";
        }
        echo ($html);
    }
    public static function getAll(){
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM users";
        $query = $db->query($sql);
        $results = $query->getResult();
        return ($results);
    }
    public static function nuevo($user){
        $db = \Config\Database::connect();
        $sql = "CALL addUser('". join("', '", $user) ."');";
        return $db->query($sql);
    }
    public static function eliminar($id){
        $db = \Config\Database::connect();
        $sql = "CALL eliminarUser(" . $id . ");";
        return $db->query($sql);
    }
    public static function actualizar($user){
        $db = \Config\Database::connect();
        $sql = "CALL upUser('". join("', '", $user) ."');";
        return $db->query($sql);
    }
    public static function userInfo($id){
        $db = \Config\Database::connect();
        $sql = "CALL userInfo(" . $id . ");";
        $query = $db->query($sql);
        $results = $query->getResult();
        return $results[0];
    }
    public static function pagination($page, $limite, $search){
        $db = \Config\Database::connect();
        $sql = "CALL totalRegistros('%" . $search . "%');";
        $query = $db->query($sql);
        $results = $query->getResult();
        $total = $results[0]->Total;
        $paginasTotales = ceil(intval($total)/intval($limite));
        $html = '';
        for($i = 1; $i <= $paginasTotales; $i++){
            if($i == $page){
                $html .= "<li class='pagination-item active'>" . $i . "</li>";
            } else{
                $html .= "<li class='pagination-item' onclick='getData(" . $i . ")'>" . $i . "</li>";
            }
        }
        $html .= "<p>Total de Registros: " . $total . "</p>";
        echo ($html);
    }
    public static function auth($user){
        $db = \Config\Database::connect();
        $sql = "CALL auth('" . $user . "');";
        $query = $db->query($sql);
        $results = $query->getResult();
        if($results){
            return $results[0];
        }else{
            return 0;
        }
    }
}