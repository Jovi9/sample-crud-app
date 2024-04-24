<?php
session_start();

use App\App;

require __DIR__ . '/../vendor/autoload.php';
include 'register-function.php';
$pageTitle = 'Register';
?>

<!DOCTYPE html>
<html lang="en">

<?php include App::getBaseDir() . 'App/includes/head.php'; ?>

<body>
    <?php
    if (isset($_SESSION['request-failed'])) {
    ?>
        <p style="color: red;"><?php echo $_SESSION['request-failed'] ?></p>
    <?php
        unset($_SESSION['request-failed']);
    }
    ?>

    <?php
    if (isset($_SESSION['register-failed'])) {
    ?>
        <p style="color: red;"><?php echo $_SESSION['register-failed'] ?></p>
    <?php
        unset($_SESSION['register-failed']);
    }
    ?>

    <h1>Register Page</h1>
    <a href="<?php echo App::routes()['login'] ?>">Login</a>
    <hr>

    <form action="" method="post">
        <input type="text" name="name" id="" required placeholder="Name:...">
        <input type="text" name="username" required placeholder="Username:...">
        <input type="password" name="password" id="" required placeholder="Password:...">
        <button type="submit" name="register">Register</button>
    </form>

</body>

</html>
