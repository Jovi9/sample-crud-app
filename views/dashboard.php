<?php
$pageTitle = "Dashboard";
include project_file('layouts', 'head');
?>

<!-- body -->
<?php include project_file('layouts', 'navigation') ?>

<h1><?= $pageTitle; ?></h1>
<h3>Logged In User: <?= appSessionData()[0]['username'] ?></h3>
<hr>

<!-- end body -->

<?php
include project_file('layouts', 'foot');
?>
