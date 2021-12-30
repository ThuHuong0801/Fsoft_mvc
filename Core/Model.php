<?php

namespace Core;

use Core\DB;
use PDO;
use PDOException;
class Model extends DB
{
    protected $connect;

    protected $table = '';

    protected $fillable = '';

    public $dataList = [];

    const SLOW_LOG = 0.5;

    public function __construct()
    {   
        $this->connect = $this->getDB();
        $this->table = $this->getNameTable();
    }

    public function getNameTable()
    {
        $result = '';

        if ($this->table == '') 
        {
            $result = str_replace('_model', '', get_class($this));
        } else
        {
            $result = $this->table;
        }
    
        return $result;
    }

    public function save($table, $data)
    {   
        $fieldList = '';
        $valueList = '';
        
        foreach ($data as $key => $value) 
        {
            $fieldList .= ",$key";
            $valueList .= ",'".$this->connect->real_escape_string($value)."'";
        }

        $sql = "INSERT INTO ".$table."(".trim($fieldList, ',').") VALUES (".trim($valueList, ',').")";
        
        $this->_query($sql);
    }
    
    public function update($table, $data, $where)
    {
        $val = '';
        
        foreach ($data as $key => $value)
        {
            $val .= "$key = '".$this->connect->real_escape_string($value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($val, ',').' WHERE '.$where;
        $this->_query($sql);
    }

    public function delete($table, $id)
    {    
        $sql = "DELETE FROM $table WHERE $id";
        $this->_query($sql);
    }
    
    public static function getAll()
    {    
        try {
            $db = static::getDB();

            $stmt = $db->query('SELECT id, title, content FROM posts 
                                ORDER BY created_at');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getById($table, $id)
    {
        $sql = "SELECT * FROM $table where id  = $id";
        $result = $this->_query($sql);
        if (!$result){
            die ('Lỗi không thể select theo id');
        }    
        $row = mysqli_fetch_assoc($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }

    private function _query($sql)
    {   
        $started = microtime(true) * 1000;
        //run query
        $result = mysqli_query($this->connect, $sql);
        
        $excuteTime = microtime(true) * 1000 - $started;
        
        if ($excuteTime > self::SLOW_LOG) {
            $this->writeLog($sql, $excuteTime);
        }

        return $result;
    }

    public function writeLog($sql, $time)
    {
        $log = [
            'logMessage' => 'Slow Log',
            'logDatatime' => date('Y-m-d H:i:s'),
            'data' => ['sql' => $sql, 'time' => $time],
        ];
        
        $this->log(json_encode($log));        
    }

    public function log($txt)
    {
        $fileLog = $txt;
        file_put_contents(''.date("Ymd").'.txt', $fileLog);

        $folderOld = "".dirname(__DIR__)."\\public\\".date("Ymd").".txt";
        $folderNew = "".dirname(__DIR__)."\\logs\\mysql\\".date("Ymd").".txt";

        rename($folderOld, $folderNew);
    }
}
