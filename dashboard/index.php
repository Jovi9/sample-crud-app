<?php

use App\App;

require __DIR__ . '/../vendor/autoload.php';
include App::getBaseDir() . 'App/includes/auth-session.php';
$pageTitle = 'Dashboard';
?>

<!DOCTYPE html>
<html lang="en">

<?php include App::getBaseDir() . 'App/includes/head.php'; ?>

<body>
    <h1>Dashboard</h1>
    <h3>Logged In User: <?php echo $_SESSION[App::userSessionData()][0]['username'] ?></h3>
</body>

</html>
