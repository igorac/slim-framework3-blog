<?php

namespace App\controllers\admin;

use App\controllers\Controller;
use App\models\admin\Admin;
use App\src\Validate;

class PerfilController extends Controller
{

    public function edit()
    {
        $admin = Admin::getUser();

        $this->view('admin.perfil', [
            'title' => 'Blog - Alterar dados do Perfil',
            'admin' => $admin, 
        ]);
    }

    public function update()
    {
        $validate = new Validate;

        $data = $validate->validate([
            'name' => 'required',
            'email' => 'required:email',
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $admin = new Admin;
        $adminFound = $admin->getUser();

        $updated = $admin->find('id', $adminFound->id)->update([
            'name' => $data->name,
            'email' => $data->email
        ]);

        if ($updated) {
            flash('message', success('Atualizado com sucesso!'));
            return back();
        }

        flash('message', error('Erro ao atualizar, tente novamente!'));
        back();
    }
}
