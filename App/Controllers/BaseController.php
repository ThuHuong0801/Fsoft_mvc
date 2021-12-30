<?php
namespace App\Controllers;

class BaseController
{
    public function index()
    {
        echo '<p1">Đây là trang chủ nè!</p>';
    }

    const VIEW_FOLDER = __DIR__ . '/Views';

    public function view($viewPath, $data = [])
    {
        foreach ($data as $key => $value) 
        {
            $$key = $value;
        }

        return require_once (self::VIEW_FOLDER . '/' . str_replace(".",'/',$viewPath) . '.php');
    }
    
}
?>