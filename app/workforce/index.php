<?php
include_once '../shared/header.php';
?>

<?php
include_once './utils/workforce.php';

$workers = getWorkers();
?>

<div class="fitcontent">
  <a href="./create" class="button" style="width: 308px; margin: 0px auto;">Új Hozzáadása</a>
  <div style="display:grid; grid: max-content / max-content max-content max-content max-content max-content; gap: 5px; margin: 0px auto; width: fit-content;">
    <?php
    foreach ($workers as $worker) {
      echo '<div class="card">' .
        '<h3 class="m-10 ta-center">' . $worker['name'] . '</h3>' .
        '<p class="m-10 ta-center">' . $worker['id'] . '</p>' .
        '<form action="./modify/index.php" method="POST" style="margin: 3px 2px;"><input type="hidden" name="id" value="' . $worker['id'] . '" /><button type="submit" name="submit" class="button form-control">Módosít</button></form>' .
        '<form action="./utils/remove.php" method="POST" style="margin: 3px 2px;"><input type="hidden" name="id" value="' . $worker['id'] . '" /><button type="submit" name="submit" class="button form-control">Töröl</button></form>' .
        '</div>';
    }
    ?>
  </div>
</div>

<?php
include_once '../shared/footer.php';
?>