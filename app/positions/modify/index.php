<?php
if (!isset($_POST["id"])) {
  header("location: ../index.php");
  exit();
}

include_once '../../shared/header.php';
?>

<?php

$id = $_POST["id"];

include_once "../utils/positions.php";
$position = getPositionById($id);
?>
<div class="container">
  <h2 class="mx-auto fit-content">Munkakör Módosítása</h2>
  <form action="../utils/modify.php" method="POST" class="fit-content mx-auto">
    <input type="hidden" name="id" value=<?php echo $position["id"] ?> />
    <input type="text" name="name" value=<?php echo $position["name"] ?> class="form-input mx-auto" placeholder="Megnevezés" required />
    <textarea class="form-input" name="description" placeholder="Leírás" rows="4" cols="50" maxlength="4000"><?php echo $position["description"]; ?></textarea>
    <button type="submit" name="submit" class="button form-control">Rendben</button>
  </form>
</div>

<?php
include_once '../../shared/footer.php';
?>