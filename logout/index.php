<?php

use App\App;

require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath($_SERVER['SCRIPT_FILENAME'])) {
     header("location:" . App::routes()['index']);
     exit();
}

include App::getBaseDir() . 'App/includes/auth-session.php';

if (isset($_POST['logout'])) {
     session_unset();
     session_destroy();
     header("location:" . App::routes()['login']);
     exit();
}
