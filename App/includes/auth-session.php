<?php

use App\App;

require __DIR__ . '/../../vendor/autoload.php';

session_start();

if (!(isset($_SESSION[App::getSession()]))) {
    header('location:' . App::routes()['login']);
    exit();
}
