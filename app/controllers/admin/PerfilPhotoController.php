<?php 

namespace App\controllers\admin;

use App\controllers\Controller;
use App\models\admin\Admin;
use App\src\Image;
use App\src\Validate;

class PerfilPhotoController extends Controller
{
    public function update()
    {
        $validate = new Validate;

        $data = $validate->validate([
            'file' => 'image'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $admin = new Admin;
        $adminFound = $admin->getUser();

        $image = new Image('file');
        $image->delete((string) $adminFound->photo);

        $image->size('user')->upload();

        $admin->find('id', $adminFound->id)->update([
            'photo' => assets("images/photos/{$image->getName()}")
        ]);

        flash('message_upload_photo_user', success('Upload feito com sucesso'));
        back();

    }
}
