<?php
session_start();
/**
 * Load the composer class autoloader
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Load the application routes
 */
require getDirectory()['src'] . 'routes.php';
