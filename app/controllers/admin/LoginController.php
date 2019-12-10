<?php

namespace App\controllers\admin;

use App\controllers\Controller;
use App\models\admin\Admin;
use App\src\Login;
use App\src\Validate;

class LoginController extends Controller
{

    public function index()
    {
        $this->view('admin.login', [
            'title' => 'Blog - Login'
        ]);
    }

    public function store()
    {
        $validate = new Validate;
        $data = $validate->validate([
            'email' => 'required:email',
            'passwd' => 'required:min@4'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }


        $login = new Login('admin'); 
        $loggedIn = $login->login($data, new Admin);

        if (!$loggedIn) {
            flash('message', error('Erro ao logar, email ou senha inválidos'));

            return back();
        }

        redirect('/admin/painel');

    }

}