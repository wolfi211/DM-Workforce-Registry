<?php
include_once '../../shared/header.php';
?>

<div class="container">
  <h2 class="mx-auto fit-content">Szervezeti egység létrehozása</h2>
  <form action="../utils/create.php" method="POST" class="mx-auto" style="width: 500px">
    <input type="text" name="name" placeholder="Megnevezés" class="form-input mx-auto" required />
    <button type="submit" name="submit" class="button form-control">Rendben</button>
  </form>
</div>

<?php
include_once '../../shared/footer.php';
?>