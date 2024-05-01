<?php
$pageTitle = "Edit Profile";
include project_file('layouts', 'head');
?>

<!-- body -->
<?php include project_file('layouts', 'navigation') ?>

<h1><?= $pageTitle; ?></h1>

<?php
if (isset($_SESSION['request-failed'])) {
?>
     <p style="color: red;"><?=  $_SESSION['request-failed'] ?></p>
<?php
     unset($_SESSION['request-failed']);
}
?>

<?php
if (isset($_SESSION['update-failed'])) {
?>
     <p style="color: red;"><?=  $_SESSION['update-failed'] ?></p>
<?php
     unset($_SESSION['update-failed']);
}
?>

<p>Name: <?=  appSessionData()[0]['name'] ?></p>
<form action="" method="post">
     <input type="text" name="name" placeholder="Enter new name:...." required>
     <button type="submit" name="edit_profile">Update</button>
</form>

<!-- end body -->

<?php
include project_file('layouts', 'foot');
?>
