<?php
include_once '../shared/header.php';
?>

<?php
include_once '../utils/dbconn.php';
include_once './utils/workforce.php';
include_once '../departments/utils/departments.php';
include_once '../positions/utils/positions.php';

$workers = getWorkers($conn);

?>

<div class="fitcontent">
  <a href="./create" class="button" style="width: 308px; margin: 0px auto;">Új Hozzáadása</a>
  <div class="box mx-auto">
    <?php
    foreach ($workers as $worker) {
      echo '<div class="card">' .
        '<h3 class="m-10 ta-center">' . $worker['name'] . '</h3>' .
        '<p class="m-10 ta-center" style="overflow: hidden;"><span style="float: left; margin-left: 20px;">Munkakör:</span><span style="float: right; margin-right: 20px;">' . getPositionById($conn, $worker['pos_id'])['name'] . '</span></p><hr style="width: 80%;" />' .
        '<p class="m-10 ta-center" style="overflow: hidden;"><span style="float: left; margin-left: 20px;">Sz.E.:</span><span style="float: right; margin-right: 20px;">' . getDepartmentById($conn, $worker['dep_id'])['name'] . '</span></p><hr style="width: 80%;" />' .
        '<p class="m-10 ta-center" style="overflow: hidden;"><span style="float: left; margin-left: 20px;">TAJ:</span><span style="float: right; margin-right: 20px;">' . $worker['ssn'] . '</span></p><hr style="width: 80%;" />' .
        '<p class="m-10 ta-center" style="overflow: hidden;"><span style="float: left; margin-left: 20px;">Adó Az.:</span><span style="float: right; margin-right: 20px;">' . $worker['taxid'] . '</span></p><hr style="width: 80%;" />' .
        '<p class="m-10 ta-center" style="overflow: hidden;"><span style="float: left; margin-left: 20px;">Bankszámla:</span><span style="float: right; margin-right: 20px;">' . $worker['ban'] . '</span></p><hr style="width: 80%;" />' .
        '<p class="m-10 ta-center" style="overflow: hidden;"><span style="float: left; margin-left: 20px;">Bruttó Bér:</span><span style="float: right; margin-right: 20px;">' . $worker['grosswage'] . ' Ft</span></p>' .
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