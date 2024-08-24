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

            header('Location: /hazard-documents'); //TODO: WITH ERRORS
            exit;

            //START SESSION
        } else {
            header('Location: /login?error=' . "Invalid login or password"); //TODO: WITH ERRORS
            exit;
        }
    }

    public function register(array $params)
    {
        if ($params['password'] !== $params['re_password']){
            header('Location: /register?error=' . "Password and Re-Password doesn't match");
        }

        if (!isset($params['first_name']) || empty($params['first_name'])){
            header('Location: /register?error=' . "First name is required");
        }

        if (!isset($params['last_name']) || empty($params['last_name'])){
            header('Location: /register?error=' . "Last name is required");
        }

        if (!isset($params['email']) || empty($params['email'])){
            header('Location: /register?error=' . "Email is required");
        }

        [$success, $userID, $message] = (new User())->store(
            $params['first_name'],
            $params['last_name'],
            $params['email'],
            $params['password']
        );

        $accessToken = bin2hex(random_bytes(64));

        $update = (new User())->update([
            'token' => $accessToken,
            'id' => $userID
        ]);

        if($update){
            $_SESSION["_accessToken"] = $accessToken;
        }

        header('Location: /hazard-documents'); //TODO: WITH ERRORS
        exit;
    }
}