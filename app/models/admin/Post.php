<?php

namespace App\models\admin;

use App\models\Model;

class Post extends Model
{
    protected $table = "posts";


    public function posts()
    {
        $this->sql = "SELECT *, posts.id as postId FROM {$this->table} INNER JOIN admins ON (posts.user_id = admins.id)";

        return $this;
    }

   
}

