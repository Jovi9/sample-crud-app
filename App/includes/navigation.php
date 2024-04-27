<?php

use App\App;

require __DIR__. '/../../vendor/autoload.php';
?>
<a href="<?php echo App::routes()['dashboard'] ?>">Dashboard</a>
<a href="<?php echo App::routes()['profile'] ?>">My Profile</a>
<br>
<form action="<?php echo App::routes()['logout'] ?>" method="post">
     <button type="submit" name="logout">Logout</button>
</form>
<hr>
