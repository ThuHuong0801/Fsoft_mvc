<?php
namespace App\Controllers;
use \Core\View;
use \Core\Model;
use App\Models\Post;

class PostsController extends BaseController
{
    
    public function __construct() 
    {
        $this->posts = new Post();
    }

    public function index()
    {
        $posts = Model::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);

    }
    public function create()
    {
        $posts = Model::getAll();
        View::renderTemplate('posts/create.html', [
            'posts' => $posts
        ]);
    }
    
    public function update()
    {
        
    }
    
    public function delete()
    {
        
    }
}
?>