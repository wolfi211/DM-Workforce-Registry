<?php
if (!isset($_POST["id"])) {
  header("location: ../index.php");
  exit();
}

include_once '../../shared/header.php';
?>

<?php

$id = $_POST["id"];

include_once "../utils/departments.php";
$department = getDepartmentById($id);
?>
<div class="container">
  <h2 class="mx-auto fit-content">Szervezeti egység módosítása</h2>
  <form action="../utils/modify.php" method="POST" class="fit-content mx-auto">
    <input type="hidden" name="id" value=<?php echo $department["id"] ?> />
    <input type="text" name="name" value=<?php echo $department["name"] ?> class="form-input mx-auto" placeholder="Megnevezés" required />
    <button type="submit" name="submit" class="button form-control">Rendben</button>
  </form>
</div>

<?php
include_once '../../shared/footer.php';
?>