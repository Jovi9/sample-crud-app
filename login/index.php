<?php
session_start();

use App\App;

require __DIR__ . '/../vendor/autoload.php';
include 'login-function.php';
$pageTitle = 'Login';
?>

<!DOCTYPE html>
<html lang="en">

<?php include App::getBaseDir() . 'App/includes/head.php'; ?>

<body>
    <?php
    if (isset($_SESSION['register-success'])) {
    ?>
        <p style="color: red;"><?php echo $_SESSION['register-success'] ?></p>
    <?php
        unset($_SESSION['register-success']);
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
    if (isset($_SESSION['invalid-creds'])) {
    ?>
        <p style="color: red;"><?php echo $_SESSION['invalid-creds'] ?></p>
    <?php
        unset($_SESSION['invalid-creds']);
    }
    ?>

    <?php
    if (isset($_SESSION['login-success'])) {
    ?>
        <p style="color: red;"><?php echo $_SESSION['login-success'] ?></p>
    <?php
        unset($_SESSION['login-success']);
    }
    ?>


    <h1>Login Page</h1>
    <a href="<?php echo App::routes()['register'] ?>">Register</a>
    <hr>

    <form action="" method="post">
        <input type="text" name="username" required placeholder="Username:...">
        <input type="password" name="password" id="" required placeholder="Password:...">
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>
