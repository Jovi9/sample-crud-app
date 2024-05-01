<?php
$pageTitle = "Register";
include project_file('layouts', 'head');
?>

<a href="<?= route('login') ?>">Login</a>
<a href="<?= route('register') ?>">Register</a>
<hr>

<h1><?= $pageTitle ?></h1>

<?php
if (($message = message(SUBMISSION_ERROR)) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>

<?php
if (($message = message('request-failed')) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>

<?php
if (($message = message('duplicate-entry')) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>

<?php
if (($message = message('register-failed')) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>

<form action="" method="post">
     <input type="text" name="name" required placeholder="Name:...">
     <input type="text" name="username" required placeholder="Username:...">
     <input type="password" name="password" required placeholder="Password:...">
     <button type="submit" name="register">Register</button>
</form>

<?php
include project_file('layouts', 'foot');
?>
