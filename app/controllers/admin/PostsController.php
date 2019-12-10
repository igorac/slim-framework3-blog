<?php

namespace App\controllers\admin;

use App\controllers\Controller;
use App\models\admin\Admin;
use App\models\admin\Post;
use App\src\Validate;
use Slim\Http\Request;
use Slim\Http\Response;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->post = new Post;
    }

    public function create()
    {
        $this->view('admin.post_create', [
            'title' => 'Blog - Cadastrar Posts'
        ]);
    }

    public function store()
    {
        $validate = new Validate;
        $data = $validate->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $post = $this->post->create([
            'title' => $data->title,
            'description' => $data->description,
            'user_id' => Admin::getUser()->id
        ]);


        if ($post) {
            flash('message', success('Post cadastrado com sucesso!'));
            return back();        
        }

        flash('message', error('Erro ao cadastrar o post'));
        return back();            
    }

    public function edit(Request $request, Response $response, array $args)
    {
        $post = $this->post->findBy('id', $args['id']);

        $this->view('admin.post_edit', [
            'title' => 'Blog - Editar Post',
            'post' => $post
        ]);
    }

    public function update(Request $request, Response $response, array $args)
    {
        $validate = new Validate;
        $data = $validate->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $updated = $this->post->find('id', $args['id'])->update([
            'title' => $data->title,
            'description' => $data->description,
        ]);

        if ($updated) {
            flash('message', success('Post alterado com sucesso!'));
            return back();
            // return redirect('/admin/painel');
        }

        flash('message', error('Erro ao atualizar'));
        back();
    }

}