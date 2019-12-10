<?php
require dirname(__DIR__) . "/bootstrap.php";


$app->get('/login', 'App\controllers\admin\LoginController:index');
$app->post('/login', 'App\controllers\admin\LoginController:store');

$app->group('/admin', function(){
    $this->get('/painel', 'App\controllers\admin\PainelController:index');
    $this->get('/post/create', 'App\controllers\admin\PostsController:create');
    $this->post('/post/store', 'App\controllers\admin\PostsController:store');
    $this->get('/post/edit/{id:[0-9]+}', 'App\controllers\admin\PostsController:edit');
    $this->put('/post/update/{id:[0-9]+}', 'App\controllers\admin\PostsController:update');
    $this->put('/post/photo/upload/{id:[0-9]+}', 'App\controllers\admin\PostsPhotoController:update');
    $this->get('/perfil/edit', 'App\controllers\admin\PerfilController:edit');
    $this->put('/perfil/update', 'App\controllers\admin\PerfilController:update');
    $this->put('/perfil/photo/upload', 'App\controllers\admin\PerfilPhotoController:update');

});

$app->run();