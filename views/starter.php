<?php
$pageTitle = "";
include project_file('layouts', 'head');
?>

<!-- body -->
<h1><?= $pageTitle ?></h1>

<?php
if (($message = message(SUBMISSION_ERROR)) !== '') {
?>
     <p style="color: red;"><?= $message; ?></p>
<?php
}
?>


<!-- end body -->

<?php
include project_file('layouts', 'foot');
?>
