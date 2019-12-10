<?php

namespace App\src;

class Password
{

    public static function make(string $password)
    {
        $options = [
            'cost' => 12,
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public static function verify(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}
