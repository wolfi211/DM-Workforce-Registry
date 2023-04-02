<?php
include_once '../shared/header.php';
?>

<?php
include_once '../utils/dbconn.php';
include_once './utils/departments.php';

$departments = getDepartments($conn);
?>

<div class="fit-content mx-auto">
  <a href="./create" class="button mx-auto">Új hozzáadása</a>
  <div style="display:grid; grid: max-content / max-content max-content max-content max-content; margin: 0px auto; width: fit-content;">
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
</div>

<?php
include_once '../shared/footer.php';
?>