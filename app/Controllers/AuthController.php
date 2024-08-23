<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login(array $params)
    {
        $user = (new User())->findByEmail($params['email']);

        if ($user && password_verify($params['password'], $user->password)) {

            $accessToken = bin2hex(random_bytes(64));

            $update = (new User())->update([
                'token' => $accessToken,
                'id' => $user->id
            ]);

            if($update){
                $_SESSION["_accessToken"] = $accessToken;
            }

            return include(base() . '/View/index.php');

            //START SESSION
        } else {
            header('Location: /login'); //TODO: WITH ERRORS
            exit;
        }
    }
}