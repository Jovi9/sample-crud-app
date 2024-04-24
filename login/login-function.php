<?php

use App\App;
use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';

if (!(isset($_SESSION[App::getSession()]))) {
    if (isset($_POST['login'])) {
        $user = new User;
        $request = [
            'username' => mysqli_real_escape_string($user->connection, $_POST['username']),
            'password' => mysqli_real_escape_string($user->connection, $_POST['password']),
        ];
        $result = $user->login($request);
        if (array_key_exists('request-failed', $result)) {
            $_SESSION['request-failed'] = $result['request-failed'];
            header('location:' . App::routes()['login']);
            exit();
        }

        if (array_key_exists('invalid-creds', $result)) {
            $_SESSION['invalid-creds'] = $result['invalid-creds'];
            header("location:" . App::routes()['login']);
            exit();
        } else {
            $_SESSION[App::getSession()] = password_hash(App::getSession() . time(), PASSWORD_BCRYPT);
            $_SESSION[App::userSessionData()] = $result;
            header("location:" . App::routes()['dashboard']);
            exit();
        }
    }
} else {
    header('location:' . App::routes()['index']);
    exit();
}
