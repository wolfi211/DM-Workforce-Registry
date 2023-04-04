<?php
include_once '../shared/header.php';
?>

<?php
include_once '../utils/dbconn.php';
include_once './utils/departments.php';

$departments = getDepartments($conn);
?>

<a href="./create" class="button w-500 mx-auto">Új hozzáadása</a>
<div id=depgrid class="mx-auto fit-content">
  <?php
  foreach ($departments as $department) {
    echo '' .
      '<span class="mx-5 my-auto">' . $department['id'] . '</span>' .
      '<span class="mx-5 my-auto">' . $department['name'] . '</span>' .
      '<form action="./modify/index.php" method="POST" class="m-3"><input type="hidden" name="id" value="' . $department['id'] . '" /><button type="submit" class="button">Módosít</button></form>' .
      '<form action="./utils/remove.php" method="POST" class="m-3"><input type="hidden" name="id" value="' . $department['id'] . '" /><button type="submit" class="button">Töröl</button></form>' .
      '';
  }
  ?>
</div>

<?php
include_once '../shared/footer.php';
?>