<?php

session_start();
ini_set('xdebug.overload_var_dump', 1);
date_default_timezone_set('America/Sao_Paulo');

require "vendor/autoload.php";

use App\src\Whoops;
use Slim\App;

$config['displayErrorDetails'] = true;

$app = new App(['settings' => $config]);

$whoops = new Whoops;
$whoops->run($app);
