<?php

namespace App\models\admin;

use App\models\Model;

class Admin extends Model
{
    protected $table = 'admins';


    public function user()
    {
        $id = $_SESSION['id_admin'];

        $this->sql = "SELECT * FROM {$this->table}";

        $this->where('id', $id);

        return $this->first();
    }

}
