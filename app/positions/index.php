<?php
include_once '../shared/header.php';
?>

<?php
include_once './utils/positions.php';

$positions = getPositions();
?>

<div class="fitcontent">
  <a href="./create" class="button" style="width: 308px; margin: 0px auto;">Új Hozzáadása</a>
  <div style="display:grid; grid: max-content / max-content max-content max-content max-content max-content; gap: 5px; margin: 0px auto; width: fit-content;">
    <?php
    foreach ($positions as $position) {
      echo '<div class="card">' .
        '<h3 class="m-10 ta-center">' . $position['name'] . '</h3>' .
        '<p class="m-10 ta-center">' . $position['id'] . '</p>' .
        '<div class="truncate m-10 ta-justify" style="height: 152px">' . nl2br($position['description']) . '</div>' .
        '<form action="./modify/index.php" method="POST" style="margin: 3px 2px;"><input type="hidden" name="id" value="' . $position['id'] . '" /><button type="submit" name="submit" class="button form-control">Módosít</button></form>' .
        '<form action="./utils/remove.php" method="POST" style="margin: 3px 2px;"><input type="hidden" name="id" value="' . $position['id'] . '" /><button type="submit" name="submit" class="button form-control">Töröl</button></form>' .
        '</div>';
    }
    ?>
  </div>
</div>

<?php
include_once '../shared/footer.php';
?>