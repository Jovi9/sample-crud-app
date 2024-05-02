<?php

namespace App\Controllers;

use App\App;
use App\Models\User;

class ProfileController
{
     function __construct()
     {
          auth();
     }
     public function index()
     {
          require view('profile/profile');
     }
     public function edit()
     {
          require view('profile/edit');
     }
     public function update($request)
     {
          postMethodChecker($request, 'edit_profile', 'profile-edit');
          $user = new User;
          $requestData = [
               'name' => mysqli_real_escape_string($user->connection, $request['name']),
               'id' => mysqli_real_escape_string($user->connection, appSessionData()[0]['user_id']),
          ];
          $result = $user->update($requestData);

          if (array_key_exists('request-failed', $result)) {
               $_SESSION['request-failed'] = $result['request-failed'];
               header('location:' . route('profile-edit'));
               exit();
          }

          if (array_key_exists('update-failed', $result)) {
               $_SESSION['update-failed'] = $result['update-failed'];
               header("location:" . route('profile-edit'));
               exit();
          } else {
               $_SESSION[App::setSessionData()] = $result;
               $_SESSION['update-success'] = "Profile updated successfully.";
               header("location:" . route('profile'));
               exit();
          }
     }
}
