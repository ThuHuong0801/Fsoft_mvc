<?php
use Core\Router;
Router::register('get', '',  [App\Controllers\BaseController::class, 'index']);
Router::register('get', '/users',  [App\Controllers\UserController::class, 'index']);


Router::register('get','/posts', [App\Controllers\PostsController::class]);
Router::register('get','/posts/viewcreate', [App\Controllers\PostsController::class, 'viewcreate']);
Router::register('post','/posts/created', [App\Controllers\PostsController::class, 'create']);
Router::register('get','/posts/find/{id}', [App\Controllers\PostsController::class, 'find']);
Router::register('get','/posts/edit/{id}', [App\Controllers\PostsController::class, 'edit']);
Router::register('post','/posts/update/{id}', [App\Controllers\PostsController::class, 'update']);
Router::register('get','/posts/delete/{id}', [App\Controllers\PostsController::class, 'delete']);
