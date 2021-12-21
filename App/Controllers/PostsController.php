<?php
namespace App\Controllers;
use \Core\View;
use App\Models\Post;

class PostsController 
{
    public function index()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);

    }
    
}
?>