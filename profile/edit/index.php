<?php

use App\App;
use App\Models\User;

require __DIR__ . '/../../vendor/autoload.php';
include App::getBaseDir() . 'App/includes/auth-session.php';
$pageTitle = 'Edit Profile';

if (isset($_POST['edit_profile'])) {
     $user = new User;
     $request = [
          'name' => mysqli_real_escape_string($user->connection, $_POST['name']),
          'id' => mysqli_real_escape_string($user->connection, $_SESSION[App::userSessionData()][0]['user_id']),
     ];
     $result = $user->update($request);

     if (array_key_exists('request-failed', $result)) {
          $_SESSION['request-failed'] = $result['request-failed'];
          header('location:' . App::routes()['edit-profile']);
          exit();
     }

     if (array_key_exists('update-failed', $result)) {
          $_SESSION['update-failed'] = $result['update-failed'];
          header("location:" . App::routes()['edit-profile']);
          exit();
     } else {
          $_SESSION[App::userSessionData()] = $result;
          $_SESSION['update-success'] = "Profile updated successfully.";
          header("location:" . App::routes()['profile']);
          exit();
     }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include App::getBaseDir() . 'App/includes/head.php' ?>

<body>
     <?php include App::getBaseDir() . 'App/includes/navigation.php' ?>
     <?php
     if (isset($_SESSION['request-failed'])) {
     ?>
          <p style="color: red;"><?php echo $_SESSION['request-failed'] ?></p>
     <?php
          unset($_SESSION['request-failed']);
     }
     ?>

     <?php
     if (isset($_SESSION['update-failed'])) {
     ?>
          <p style="color: red;"><?php echo $_SESSION['update-failed'] ?></p>
     <?php
          unset($_SESSION['update-failed']);
     }
     ?>

     <h1>Edit Name</h1>
     <p>Name: <?php echo $_SESSION[App::userSessionData()][0]['name'] ?></p>
     <form action="" method="post">
          <input type="text" name="name" placeholder="Enter new name:...." required>
          <button type="submit" name="edit_profile">Update</button>
     </form>
</body>

</html>
