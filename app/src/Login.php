<?php

namespace App\src;

use App\models\Model;

class Login
{

    private $type;
    private $config;

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->config = (object) Load::file('/config.php')['login'][$this->type];
    }

    public function login(object $data, Model $model)
    {

        if (!isset($this->type)) {
            throw new \Exception("Para fazer o login, verifique se está passando o tipo");
        }

        $user = $model->findBy('email', $data->email);

        if (!$user) {
            return false;
        }

        if (Password::verify($data->passwd, $user->passwd)) {
            $_SESSION[$this->config->idLoggedIn] = $user->id;
            $_SESSION[$this->config->loggedIn] = true;
            return true;
        }

        return false;
    }

    public function verify()
    {
        return (isset($_SESSION[$this->config->idLoggedIn]) && $_SESSION[$this->config->loggedIn]) ? true : false;
    }

    public function logout()
    {
        session_destroy();
        redirect($this->config->redirect);
    }
}

