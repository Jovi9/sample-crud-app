<?php

// Define routing pages for application

use Routing\Route;
use App\Controllers\DashboardController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\ProfileController;
use App\Controllers\UserController;

$route = new Route();

$route->get(routeSet('base', ''), function () {
     header("location:" . route('login'));
     exit();
});

$route->get(routeSet('login', 'login'), LoginController::class . '::index');
$route->post(route('login', FROM_ROUTE), LoginController::class . '::login');

$route->get(routeSet('register', 'register'), RegisterController::class . '::index');
$route->post(route('register', FROM_ROUTE), RegisterController::class . '::register');

$route->get(routeSet('dashboard', 'dashboard'), DashboardController::class . '::index');

$route->get(routeSet('profile', 'profile'), ProfileController::class . '::index');
$route->get(routeSet('profile-edit', 'profile/edit'), ProfileController::class . '::edit');
$route->post(route('profile-edit', FROM_ROUTE), ProfileController::class . '::update');

$route->get(routeSet('users', 'users'), UserController::class . '::index');
$route->get(routeSet('users-edit', 'users/edit'), UserController::class . '::edit');
$route->post(route('users-edit', FROM_ROUTE), UserController::class . '::update');

$route->post(routeSet('logout', 'logout'), function ($request) {
     auth();
     if (isset($request['logout'])) {
          session_unset();
          session_destroy();
          header("location:" . route('login'));
          exit();
     } else {
          header('HTTP/1.0 401 Unauthorized');
          die();
     }
});

$route->addNotFoundHandler(function () {
     require view('errors/error');
});

$route->run();
