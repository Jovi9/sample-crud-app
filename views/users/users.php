<?php
$pageTitle = "Users";
include project_file('layouts', 'head');
?>

<!-- body -->
<?php include project_file('layouts', 'navigation') ?>

<h1><?= $pageTitle; ?></h1>
<hr>

<?php
if (($message = message(SUBMISSION_ERROR)) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>

<?php
if (($message = message('no-user-found')) !== '') {
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
if (($message = message('update-failed')) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>

<?php
if (($message = message('update-success')) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>


<h4>Number of Users: <?= $userCount ?></h4>
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
          if (strtolower(appSessionData()[0]['username']) === 'admin') {
          ?>
               <th>Action</th>
          <?php
          }
          ?>
     </thead>
     <tbody>
          <?php
          if (!array_key_exists('null', $users)) {
               foreach ($users as $user) {
          ?>
                    <tr>
                         <td><?= $user['name'] ?></td>
                         <td><?= $user['username'] ?></td>
                         <td><?= $user['created_at'] ?></td>
                         <td><?= $user['updated_at'] ?></td>
                         <?php
                         if (strtolower(appSessionData()[0]['username']) === 'admin') {
                         ?>
                              <td><a href="<?= route('users-edit') . '?user=' . $user['user_id'] ?>">Edit</a></td>
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

<!-- end body -->

<?php
include project_file('layouts', 'foot');
?>
