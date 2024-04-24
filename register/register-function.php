<?php

use App\App;
use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';

if (!isset($_SESSION[App::getSession()])) {
    if (isset($_POST['register'])) {
        $user = new User;
        $request = [
            'name' => mysqli_real_escape_string($user->connection, $_POST['name']),
            'username' => mysqli_real_escape_string($user->connection, $_POST['username']),
            'password' => mysqli_real_escape_string($user->connection, $_POST['password']),
        ];

        $result = $user->register($request);

        if (array_key_exists('request-failed', $result)) {
            $_SESSION['request-failed'] = $result['request-failed'];
            header('location:' . App::routes()['register']);
            exit();
        }

        if (array_key_exists('register-success', $result)) {
            $_SESSION['register-success'] = $result['register-success'];
            header("location:" . App::routes()['login']);
            exit();
        } else {
            $_SESSION['register-failed'] = $result['register-failed'];
            header("location:" . App::routes()['register']);
            exit();
        }
    }
} else {
    header('location:' . App::routes()['index']);
    exit();
}
