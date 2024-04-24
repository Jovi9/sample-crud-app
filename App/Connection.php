<?php

namespace App;

class Connection
{
    public $connection = '';

    function __construct()
    {
        $this->connection = new \mysqli(App::env()['DB_HOST'], App::env()['DB_USERNAME'], App::env()['DB_PASSWORD'], App::env()['DB_DATABASE']) or die('Error connecting to server' . mysqli_connect_error());
    }
}

