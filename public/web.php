<?php
use Core\Router;
Router::register('get', '',  [App\Controllers\BaseController::class, 'index']);
Router::register('get', '/users',  [App\Controllers\UserController::class, 'index']);


Router::register('get','/posts', [App\Controllers\PostsController::class]);
Router::register('get','/posts/create', [App\Controllers\PostsController::class, 'create']);
Router::register('get','/posts/edit/{id}', [App\Controllers\PostsController::class, 'edit']);
