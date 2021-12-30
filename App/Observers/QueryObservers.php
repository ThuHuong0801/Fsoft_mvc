<?php
namespace app\Observers;

trait QueryObservers
{
    public function beforeSelect(&$sql_where)
    {
        $sql_where = $sql_where. 'AND delete_at = null';
    }
    public function afterSelect(){

    }
    public function beforeInsert(){

    }
    public function afterInsert(){

    }

}