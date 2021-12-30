<?php
namespace app\Controllers;
use \Core\View;
use app\Repositories\PostsRepository;
use app\Controllers\BaseController;

class PostsController extends BaseController 
{

    protected $postRepo;

    public function __construct()
    {
        $this->postRepo = new PostsRepository();
    }

    public function index()
    {
        $posts = $this->postRepo->getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }
    
    public function viewcreate()
    {
        View::renderTemplate('Posts/create.html');
    }

    public function create()
    {
        if(isset($_POST['submit']))
        {
            $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content']
            ];
        }
        var_dump($data);
        $this->postRepo->insertdata($data);
        echo "<br/>";
        echo "<a href='/posts'>Back for home page</a>";
    }

    public function find($id)
    {
        $posts = $this->postRepo->find($id);
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    public function edit($id)
    {
        $posts = $this->postRepo->find($id);
        View::renderTemplate('Posts/edit.html', [
            'posts' => $posts
        ]);
    }
    public function update($id)
    {
        if(isset($_POST['submit']))
        {
            $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content']
            ];
        }
        $this->postRepo->updatedata($data, $id);
        echo "<br/>";
        echo "<a href='/posts'>Back for home page</a>";
    }

    public function delete($id)
    {
        $this->postRepo->delete($id);
        echo "Bạn đã xóa thành công rồi nè!";
        echo "<br/>";
        echo "<a href='/posts'>Back for home page</a>";
    }
}
