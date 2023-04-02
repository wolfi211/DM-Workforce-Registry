<?php
include_once '../../shared/header.php';
?>

<?php
include_once '../../utils/dbconn.php';
include_once '../../departments/utils/departments.php';
include_once '../../positions/utils/positions.php';
$departments = getDepartments($conn);
$positions = getPositions($conn);
?>

<div class="container">
  <h2 class="mx-auto fit-content">Dolgozó létrehozása</h2>
  <form name="create" action="../utils/create.php" method="POST" class="mx-auto" onsubmit="return validateForm()" style="width: 500px">
    <input type="text" id="name" name="name" placeholder="Név" class="form-input mx-auto" required />
    <input type="number" name="taxid" placeholder="Adó Azonosító" class="form-input mx-auto" required />
    <input type="number" name="socsec" placeholder="TAJ Szám" class="form-input mx-auto" required />
    <input id="bankacc" type="text" name="bankacc" placeholder="Bankszámla Szám" class="form-input mx-auto" required />
    <input type="number" name="wage" placeholder="Bruttó Bér" class="form-input mx-auto" required />
    <label class="form-input-label" for="position">Munkakör</label>
    <select id="position" name="position" class="form-input" style="margin-top: 5px;">
      <?php
      foreach ($positions as $position) {
        echo '<option value=' . $position["id"] . '>' . $position["name"] . '</option>';
      }
      ?>
    </select>
    <label class="form-input-label" for="department">Szervezeti Egység</label>
    <select name="department" class="form-input" style="margin-top: 5px;">
      <?php
      foreach ($departments as $department) {
        echo '<option value=' . $department["id"] . '>' . $department["name"] . '</option>';
      }
      ?>
    </select>
    <button type="submit" name="submit" class="button form-control">Rendben</button>
  </form>
</div>

<script>
  /* function validateForm() {
    let bank = document.forms["create"]["bankacc"].value.split("");

    if (x == "") {
      alert("Name must be filled out");
      return false;
    }
  } */

  const bankOnChange = () => {
    let bank = document.forms["create"]["bankacc"];
    alert(bank);
    let regex = /^[0-9-]*$./;
    if (!bank.match(regex)) {
      return false;
    } else if (!bank.slice(-1).match(/^[0-9]*$./)) {
      return false;
    }
    let withoutdash = bank.map(char => {
      if (char.match(/^[0-9]*$./)) return char;
    })
    if (count(withoutdash) % 8 == 0) {
      document.forms["create"]["bankacc"].push("-");
    }
  };

  document.forms["create"]["bankacc"].addEventListener("change", bankOnChange);
</script>

<?php
include_once '../../shared/footer.php';
?>