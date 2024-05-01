<?php
session_start();
// class autoloader
require __DIR__ . '/../vendor/autoload.php';

// load routes
require getDirectory()['src'] . 'routes.php';
