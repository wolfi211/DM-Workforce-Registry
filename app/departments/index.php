<?php
include_once '../shared/header.php';
?>

<?php
include_once '../utils/dbconn.php';
include_once './utils/departments.php';
include_once '../workforce/utils/workforce.php';
include_once '../positions/utils/positions.php';

$departments = getDepartments($conn);
?>

<a href="./create" class="button w-500 mx-auto">Új hozzáadása</a>

<?php
foreach ($departments as $department) {
  $workers = getWorkersByDepId($conn, $department["id"]);
  echo '<div id=' . $department["id"] . ' class="mx-auto my-10" style="width: 700px; overflow: hidden; padding: 3px;" onclick="toggleWorkers(this)">' .
    '<h3 class="mx-5 my-auto fl">' . $department['name'] . '</h3>' .
    '<div class="dep-button-container fr">' .
    '<form action="./modify/index.php" method="POST"><input type="hidden" name="id" value="' . $department['id'] . '" /><button type="submit" class="button form-control">Módosít</button></form>' .
    '<form action="./utils/remove.php" method="POST"><input type="hidden" name="id" value="' . $department['id'] . '" /><button type="submit" class="button form-control">Töröl</button></form>' .
    '</div>' .
    '</div>';
  echo '<div id=d' . $department["id"] . ' class="box mx-auto" style="display:none;">';
  foreach ($workers as $worker) {
    echo '<div class="card border">' .
      '<h3 class="ta-center">' . $worker['name'] . '</h3>' .
      '<p class="ta-center card-item h-60">' .
      '<span class="mx-10 fl">Munkakör:</span>' .
      '<br />' .
      '<span class="mx-20 fr">' . getPositionById($conn, $worker['pos_id'])['name'] . '</span>' .
      '</p>' .
      '<hr />' .
      '<p class="ta-center card-item">' .
      '<span class="mx-10 fl">Bruttó Bér:</span><span class="mx-20 fr">' . $worker['grosswage'] . ' Ft</span>' .
      '</p>' .
      '</div>';
  }
  echo '</div>' .
    '<hr  style="width: 700px;"/>';
}
?>

<script>
  function toggleWorkers(ele) {
    let id = ele.id;
    let workersDiv = document.getElementById("d" + id);
    let depDiv = document.getElementById(id);
    if (workersDiv.style.display === "none") {
      workersDiv.style.display = "flex";
      depDiv.style.border = "2px solid #4285f4";
    } else {
      workersDiv.style.display = "none";
      depDiv.style.border = "none";
    }
  }
</script>

<?php
include_once '../shared/footer.php';
?>