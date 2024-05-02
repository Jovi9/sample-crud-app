<?php

namespace App\Controllers\Auth;

use App\Models\User;
use mysqli;
use mysqli_sql_exception;

class RegisterController
{
     function __construct()
     {
          guest();
     }

     public function index(): void
     {
          require view('auth/register');
     }
     public function register($request)
     {
          postMethodChecker($request, 'register', 'register');
          $user = new User;
          $requestData = [
               'name' => mysqli_real_escape_string($user->connection, $request['name']),
               'username' => mysqli_real_escape_string($user->connection, $request['username']),
               'password' => mysqli_real_escape_string($user->connection, $request['password']),
          ];

          try {
               $result = $user->register($requestData);
          } catch (mysqli_sql_exception $ex) {
               if (str_contains(strtolower($ex->getMessage()), 'duplicate') === true) {
                    $_SESSION['duplicate-entry'] = "Username not available.";
                    header('location:' . route('register'));
                    exit();
               } else {
                    $_SESSION['request-failed'] = "Request failed, please try again.";
                    header('location:' . route('register'));
                    exit();
               }
          }

          if (array_key_exists('request-failed', $result)) {
               $_SESSION['request-failed'] = $result['request-failed'];
               header('location:' . route('register'));
               exit();
          }

          if (array_key_exists('register-success', $result)) {
               $_SESSION['register-success'] = $result['register-success'];
               header("location:" . route('login'));
               exit();
          } else {
               $_SESSION['register-failed'] = $result['register-failed'];
               header("location:" . route('register'));
               exit();
          }
     }
}
