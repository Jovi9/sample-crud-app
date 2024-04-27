<?php

use App\App;
use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';
include App::getBaseDir() . 'App/includes/auth-session.php';
$pageTitle = 'Edit User';
$user = array();

if (isset($_GET['user'])) {
     $user = new User;
     $id = mysqli_real_escape_string($user->connection, $_GET['user']);
     $result = $user->getUser($id);

     if (!($result === null)) {
          $user = $result;
     } else {
          $_SESSION['no-user-found'] = "No user found.";
          header('location:' . App::routes()['edit-user']);
          exit();
     }
}
if (isset($_POST['update-user'])) {
     $user = new User;
     $request = [
          'name' => mysqli_real_escape_string($user->connection, $_POST['name']),
          'id' => mysqli_real_escape_string($user->connection, $_POST['id']),
     ];
     $result = $user->update($request);

     if (array_key_exists('request-failed', $result)) {
          $_SESSION['request-failed'] = $result['request-failed'];
          header('location:' . App::routes()['edit-user']);
          exit();
     }

     if (array_key_exists('update-failed', $result)) {
          $_SESSION['update-failed'] = $result['update-failed'];
          header("location:" . App::routes()['edit-user']);
          exit();
     } else {
          $_SESSION['update-success'] = "User updated successfully.";
          header("location:" . App::routes()['dashboard']);
          exit();
     }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include App::getBaseDir() . 'App/includes/head.php'; ?>

<body>
     <?php include App::getBaseDir() . 'App/includes/navigation.php' ?>

     <?php
     if (isset($_SESSION['no-user-found'])) {
     ?>
          <p style="color: red;"><?php echo $_SESSION['no-user-found'] ?></p>
     <?php
          unset($_SESSION['no-user-found']);
     }
     ?>
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

     <h1><?php echo $pageTitle ?></h1>

     <h4>User Information</h4>
     <p>Name: <?php echo $user[0]['name'] ?></p>
     <p>Username: <?php echo $user[0]['username'] ?></p>
     <p>Created At: <?php echo $user[0]['created_at'] ?></p>
     <p>Updated At: <?php echo $user[0]['updated_at'] ?></p>

     <form action="" method="post">
          <input type="text" name="id" readonly hidden value="<?php echo $user[0]['user_id'] ?>">
          <input type="text" name="name" required placeholder="Enter new name....">
          <button type="submit" name="update-user">Update User</button>
     </form>
</body>

</html>
