<?php

use App\App;
use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';
include App::getBaseDir() . 'App/includes/auth-session.php';
$pageTitle = 'Dashboard';
?>

<!DOCTYPE html>
<html lang="en">

<?php include App::getBaseDir() . 'App/includes/head.php'; ?>

<body>
     <?php include App::getBaseDir() . 'App/includes/navigation.php' ?>

     <h1>Dashboard</h1>
     <h3>Logged In User: <?php echo $_SESSION[App::userSessionData()][0]['username'] ?></h3>
     <hr>

     <?php
     if (isset($_SESSION['update-success'])) {
     ?>
          <p style="color: red;"><?php echo $_SESSION['update-success'] ?></p>
     <?php
          unset($_SESSION['update-success']);
     }
     ?>

     <?php
     $userCount = (new User())->GetNumberOfUsers();
     ?>
     <h4>Number of Users: <?php echo $userCount ?></h4>
     <?php
     ?>
     <hr>
     <table>
          <thead>
               <th>Name</th>
               <th>Username</th>
               <th>Created At</th>
               <th>Updated At</th>
               <?php
               if (strtolower($_SESSION[App::userSessionData()][0]['username']) === 'admin') {
               ?>
                    <th>Action</th>
               <?php
               }
               ?>
          </thead>
          <tbody>
               <?php
               $users = (new User())->loadUsers();
               if (!array_key_exists('null', $users)) {
                    foreach ($users as $user) {
               ?>
                         <tr>
                              <td><?php echo $user['name'] ?></td>
                              <td><?php echo $user['username'] ?></td>
                              <td><?php echo $user['created_at'] ?></td>
                              <td><?php echo $user['updated_at'] ?></td>
                              <?php
                              if (strtolower($_SESSION[App::userSessionData()][0]['username']) === 'admin') {
                              ?>
                                   <td><a href="<?php echo App::routes()['edit-user'] . '?user=' . $user['user_id'] ?>">Edit</a></td>
                              <?php
                              }
                              ?>
                         </tr>
               <?php
                    }
               }
               ?>
          </tbody>
     </table>
</body>

</html>
