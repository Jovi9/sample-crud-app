<?php
$pageTitle = "My Profile";
include project_file('layouts', 'head');
?>

<!-- body -->
<?php include project_file('layouts', 'navigation') ?>

<h1><?= $pageTitle; ?></h1>

<?php
if (isset($_SESSION['update-success'])) {
?>
     <p style="color: red;"><?= $_SESSION['update-success'] ?></p>
<?php
     unset($_SESSION['update-success']);
}
?>

<p>Name: <?= appSessionData()[0]['name'] ?></p>
<p>Username: <?= appSessionData()[0]['username'] ?></p>
<p>Account Created At: <?= appSessionData()[0]['created_at'] ?></p>
<p>Account Last Updated At: <?= appSessionData()[0]['updated_at'] ?></p>
<a href="<?= route('profile-edit') ?>">Edit Name</a>

<!-- end body -->

<?php
include project_file('layouts', 'foot');
?>
