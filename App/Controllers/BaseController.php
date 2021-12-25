<?php
namespace App\Controllers;

class BaseController
{
    public function index()
    {
        echo '<p1">Đây là trang chủ nè!</p>';
    }
    
    public function view($view, $data = [])
    {
        if(file_exists('../app/views/'.$view.'.php'))
        {
            require_once '../app/views/'.$view.'.php';
        } else {
            http_response_code(404);
            die('Not Found!');
        }
    }
    
}
?>