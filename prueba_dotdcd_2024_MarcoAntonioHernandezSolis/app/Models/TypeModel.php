<?php 
namespace App\Models;

use CodeIgniter\CLI\Console;
use CodeIgniter\Model;
use Faker\Core\Number;

class TypeModel extends Model{
    protected $table      = 'usertypes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'role'];
    public static function getTypes() {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM usertypes";
        $query = $db->query($sql);
        $results = $query->getResult();
        return $results;
    }
}