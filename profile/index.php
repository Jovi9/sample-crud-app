<?php

use App\App;

require __DIR__ . '/../vendor/autoload.php';
include App::getBaseDir() . 'App/includes/auth-session.php';
$pageTitle = 'Profile';

?>

<!DOCTYPE html>
<html lang="en">
<?php include App::getBaseDir() . 'App/includes/head.php'; ?>

<body>
     <?php include App::getBaseDir() . 'App/includes/navigation.php' ?>
     <?php
     if (isset($_SESSION['update-success'])) {
     ?>
          <p style="color: red;"><?php echo $_SESSION['update-success'] ?></p>
     <?php
          unset($_SESSION['update-success']);
     }
     ?>
     <h1>PRofile Page</h1>
     <p>Name: <?php echo $_SESSION[App::userSessionData()][0]['name'] ?></p>
     <p>Username: <?php echo $_SESSION[App::userSessionData()][0]['username'] ?></p>
     <p>Account Created At: <?php echo $_SESSION[App::userSessionData()][0]['created_at'] ?></p>
     <p>Account Last Updated At: <?php echo $_SESSION[App::userSessionData()][0]['updated_at'] ?></p>
     <a href="<?php echo App::routes()['edit-profile'] ?>">Edit Name</a>
</body>

</html>
