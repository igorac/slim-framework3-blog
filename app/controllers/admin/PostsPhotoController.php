<?php

namespace App\controllers\admin;

use App\controllers\Controller;
use App\models\admin\Post;
use App\src\Image;
use App\src\Validate;
use Slim\Http\Request;
use Slim\Http\Response;

class PostsPhotoController extends Controller
{
    public function update(Request $request, Response $response, array $args)
    {
        $validate = new Validate;
        $validate->validate([
            'file' => 'image'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $post = new Post;
        $postFound = $post->findBy('id', $args['id']);

        $image = new Image('file');
        $image->delete((string) $postFound->photo);

        $image->size('post')->upload();
        
        $post->find('id', $args['id'])->update([
            'photo' => assets("images/photos/{$image->getName()}"),
        ]);

        flash('message_upload_photo_post', success('Upload feito com sucesso!'));
        back();
    }
}
