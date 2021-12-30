<?php

namespace App\Models;
use Core\Model;
use Core\DB;

use PDO;
use PDOException;

// require '../Core/Model.php';
/**
 * Post model
 */
class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['id','title','content'];

    public function __construct()
    {
        $this->tableName = $this->table;
        $this->fillable_name = $this->fillable;
        $this->db = DB::getDB();
    }
}
