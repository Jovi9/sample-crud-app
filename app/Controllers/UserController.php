<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
     function __construct()
     {
          auth();
          if (!(strtolower(appSessionData()[0]['username']) === 'admin')) {
               header("location:" . route('login'));
               exit();
          }
     }
     public function index()
     {
          $users = (new User())->loadUsers();
          $userCount = (new User())->GetNumberOfUsers();
          require view('users/users');
     }
     public function edit($request)
     {
          getMethodChecker($request, 'user', 'users');
          $user = new User;
          $id = mysqli_real_escape_string($user->connection, $request['user']);
          $result = $user->getUser($id);

          if (!($result === null)) {
               $user = $result;
          } else {
               $_SESSION['no-user-found'] = "No user found.";
               header('location:' . route('users'));
               exit();
          }
          require view('users/edit');
     }
     public function update($request)
     {
          postMethodChecker($request, 'update-user', 'users');
          $user = new User;
          $requestData = [
               'name' => mysqli_real_escape_string($user->connection, $request['name']),
               'id' => mysqli_real_escape_string($user->connection, $request['id']),
          ];
          $result = $user->update($requestData);

          if (array_key_exists('request-failed', $result)) {
               $_SESSION['request-failed'] = $result['request-failed'];
               header('location:' . route('users'));
               exit();
          }

          if (array_key_exists('update-failed', $result)) {
               $_SESSION['update-failed'] = $result['update-failed'];
               header("location:" . route('users'));
               exit();
          } else {
               $_SESSION['update-success'] = "User updated successfully.";
               header("location:" . route('users'));
               exit();
          }
     }
}
