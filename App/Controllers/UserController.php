<?php
namespace App\Controllers;
use \Core\View;

class UserController 
{
    public function index()
    {
        //echo $id;
        // View::render('Home/index.php', [
        //     'name' => 'Thư Hường',
        //     'colours'=> ['red', 'green', 'blue']
        // ]);
        View::renderTemplate('Home/index.html', [
            'name'    => 'Thư Hường',
            'colours' => ['red', 'green', 'blue']
        ]);

    }
    
}
?>