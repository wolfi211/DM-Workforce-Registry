<?php
include_once '../shared/header.php';
?>

<?php
include_once '../utils/dbconn.php';
include_once './utils/positions.php';

$positions = getPositions($conn);
?>

<a href="./create" class="button w-500 mx-auto">Új Hozzáadása</a>
<div class=" box mx-auto mt-10">
  <?php
  foreach ($positions as $position) {
    echo '<div class="card">' .
      '<h3 class="ta-center h-40 m-0">' . $position['name'] . '</h3>' .
      '<hr />' .
      '<div class="truncate ta-justify mx-5" style="height: 152px">' . nl2br($position['description']) . '</div>' .
      '<form action="./modify/index.php" method="POST" class="my-5"><input type="hidden" name="id" value="' . $position['id'] . '" /><button type="submit" name="submit" class="button form-control">Módosít</button></form>' .
      '<form action="./utils/remove.php" method="POST" class="my-5"><input type="hidden" name="id" value="' . $position['id'] . '" /><button type="submit" name="submit" class="button form-control">Töröl</button></form>' .
      '</div>';
  }
  ?>
</div>

<?php
include_once '../shared/footer.php';
?>