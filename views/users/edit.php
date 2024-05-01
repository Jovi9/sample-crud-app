<?php
$pageTitle = "Edit User";
include project_file('layouts', 'head');
?>

<!-- body -->
<?php include project_file('layouts', 'navigation') ?>

<h1><?= $pageTitle ?></h1>

<?php
if (($message = message(SUBMISSION_ERROR)) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>

<h4>User Information</h4>
<p>Name: <?= $user[0]['name'] ?></p>
<p>Username: <?= $user[0]['username'] ?></p>
<p>Created At: <?= $user[0]['created_at'] ?></p>
<p>Updated At: <?= $user[0]['updated_at'] ?></p>

<form action="" method="post">
     <input type="text" name="id" readonly hidden value="<?= $user[0]['user_id'] ?>">
     <input type="text" name="name" required placeholder="Enter new name....">
     <button type="submit" name="update-user">Update User</button>
</form>

<!-- end body -->

<?php
include project_file('layouts', 'foot');
?>
