<?php

namespace App\controllers\admin;

use App\controllers\Controller;
use App\models\admin\Post;

class PainelController extends Controller
{

    public function index()
    {
        $post = new Post;
        $posts = $post->posts()->busca('title,description')->orderBy('id', 'desc')->paginate(20)->get();

        $this->view('admin.painel', [
            'title' => 'Blog - Painel Administrativo',
            'posts' => $posts,
            'links' => $post->links(),
        ]);
    }
}