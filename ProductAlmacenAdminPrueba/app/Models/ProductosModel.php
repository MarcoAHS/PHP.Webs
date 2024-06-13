<?php 
namespace App\Models;

use CodeIgniter\CLI\Console;
use CodeIgniter\Model;
use Faker\Core\Number;

class ProductosModel extends Model{
    protected $table      = 'producto';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'name', 'precio', 'id_almacen'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    public static function getAlmacenes(){
        $db = \Config\Database::connect();
        $sql = "CALL getAlmacenes();";
        $query = $db->query($sql);
        $results = $query->getResult();
        return $results;
    }
    public static function getProductosJoinAlmacen($limite, $page, $search){
        if($page){
            $inicio = ($page - 1) * $limite;
        } else{
            $inicio = 0;
            $page = 1;
        }
        $db = \Config\Database::connect();
        $sql = "CALL getProductosJoinAlmacen(". $inicio . ", " . $limite .", '%" . $search . "%');";
        $query = $db->query($sql);
        $results = $query->getResult();
        $html = '';
        foreach($results as $result){
            $html .= "<tr>";
            foreach($result as $key => $value){    
                $html .= "<td>" . $value . "</td>";
            }
            $html .= "<td>";
            $html .= "<button class='editarModal' onclick='leerProducto(" . $result->id . ")'>Editar</button>";
            $html .= "<button onclick='eliminarProducto(" . $result->id . ")'>Elimanar</button>";
            $html .= "</td>";
            $html .= "</tr>";
        }
        echo ($html);
    }
    public static function getAll(){
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM producto";
        $query = $db->query($sql);
        $results = $query->getResult();
        return ($results);
    }
    public static function nuevo($name, $precio, $id_almacen){
        $db = \Config\Database::connect();
        $sql = "CALL nuevoProducto('" . $name . "', '" . $precio . "', '" . $id_almacen . "');";
        return $db->query($sql);
    }
    public static function eliminar($id){
        $db = \Config\Database::connect();
        $sql = "CALL eliminarProducto(" . $id . ");";
        return $db->query($sql);
    }
    public static function actualizar($id, $name, $precio, $id_almacen){
        $db = \Config\Database::connect();
        $sql = "UPDATE `producto` SET name = '" . $name . "', precio = '" . $precio . "', id_almacen = '" . $id_almacen . "' WHERE id = '" . $id . "'";
        return $db->query($sql);
    }
    public static function Producto($id){
        $db = \Config\Database::connect();
        $sql = "CALL leerProducto(" . $id . ");";
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
        echo ($html);
    }
}