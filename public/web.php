<?php
use Core\Router;
Router::register('get', '',  [App\Controllers\BaseController::class, 'index']);
Router::register('get', '/users',  [App\Controllers\UserController::class, 'index']);


Router::register('get','/posts', [App\Controllers\PostsController::class]);

Router::register('get','/students/list', [\app\controllers\StudentsController::class, 'index']);
Router::register('get','/students/create', [App\Controllers\StudentsController::class, 'create']);
Router::register('get','/students/edit/{id}', [App\Controllers\StudentsController::class, 'edit']);
