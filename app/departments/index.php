<?php
include_once '../shared/header.php';
?>

<?php
include_once './utils/departments.php';

$departments = getDepartments();
?>

<div class="container">
  <?php
  foreach ($departments as $department) {
    echo '<div style="display:flex;"><span>' . $departmnet['id'] . '</span><span>' . $department['name'] . '</span></div>';
  }
  ?>
</div>

<?php
include_once '../shared/footer.php';
?>