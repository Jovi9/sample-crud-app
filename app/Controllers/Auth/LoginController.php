<?php

namespace App\Controllers\Auth;

use App\App;
use App\Models\User;

class LoginController
{
     function __construct()
     {
          guest();
     }
     public function index($request): void
     {
          requestChecker($request);
          require view('auth/login');
     }

     public function login(array $request): void
     {
          postMethodChecker($request, 'login', 'login');
          $user = new User;
          $requestData = [
               'username' => mysqli_real_escape_string($user->connection, $request['username']),
               'password' => mysqli_real_escape_string($user->connection, $request['password']),
          ];
          $result = $user->login($requestData);
          if (array_key_exists('request-failed', $result)) {
               $_SESSION['request-failed'] = $result['request-failed'];
               header('location:' . route('login'));
               exit();
          }
          if (array_key_exists('invalid-creds', $result)) {
               $_SESSION['invalid-creds'] = $result['invalid-creds'];
               header("location:" . route('login'));
               exit();
          } else {
               $_SESSION[App::setSession()] = password_hash(App::setSession() . time(), PASSWORD_BCRYPT);
               $_SESSION[App::setSessionData()] = $result;
               header("location:" . route('dashboard'));
               exit();
          }
     }
}
