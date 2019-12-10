<?php

/**
 * Functions Custons Twig
 */

use App\models\admin\Admin;
use App\src\Flash;
use Carbon\Carbon;

$message = new \Twig\TwigFunction('message', function($index){
    echo Flash::get($index);
});

$assets = new \Twig\TwigFunction('assets', function($target) {
    echo assets($target);
});

$dd = new \Twig\TwigFunction('dd', function($dados){
    dd($dados);
});

$admin = new \Twig\TwigFunction('admin', function() {
    $user = Admin::getUser();

    if (is_null($user->photo)) {
        $user->photo = assets('images/photos/default.png');
    }

    return $user;
}); 

$timeAgo = new \Twig\TwigFunction('timeAgo', function($date) {
    Carbon::setLocale('pt-br'); // Traduz para PT-BR

    $dateFormat = Carbon::parse($date);
    return $dateFormat->diffForHumans();
}); 


// Responsável por retornar as functions
return [ 
  $message,
  $assets,
  $dd,
  $admin,
  $timeAgo
];