<?php
namespace app\Repositories;
use app\Models\Post;
// require '../app/Models/Post.php';

class PostsRepository{
    protected $model;
    protected $table;
    protected $fillable;

    public function __construct()
    {
        $this->model = new Post();
        $this->table = $this->model->fillable_name;
        $this->fillable = $this->model->fillable_name;
    }
    public function getAll()
    {
        return $this->model->getAll();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function insertdata($data)
    {
        return $this->model->insert($data);
    }

    public function updatedata($data, $id)
    {
        return $this->model->update($data, $id);
    }
    public function delete($id)
    {
        return $this->model->delete($id);
    }

}