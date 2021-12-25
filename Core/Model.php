<?php

namespace Core;

use Core\DB;
class Model extends DB
{
    protected $connect;

    protected $table = '';

    protected $fillable = '';

    public $dataList = [];

    const SLOW_LOG = 0.5;

    public function __construct()
    {   
        $this->connect = $this->connect();
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
    
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->_query($sql);
        var_dump($result);
        if (!$result){
            die ('Lỗi không thể select');
        }
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }
        return $data;
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
        $result = mysqli_query($this->connect, $sql);     
        $excuteTime = microtime(true) * 1000 - $started;
        return $result;
    }
}
