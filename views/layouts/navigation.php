<a href="<?= route('dashboard') ?>">Dashboard</a>
<a href="<?= route('profile') ?>">My Profile</a>
<?php
if (strtolower(appSessionData()[0]['username']) === 'admin') {
?>
     <a href="<?= route('users') ?>">Users</a>
<?php
}
?>
<br>
<form action="<?= route('logout') ?>" method="post">
     <button type="submit" name="logout">Logout</button>
</form>
<hr>
