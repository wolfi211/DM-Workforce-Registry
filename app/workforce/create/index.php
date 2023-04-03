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
    <!-- NAME -->
    <input type="text" name="name" placeholder="Név" class="form-input mx-auto" required />
    <!-- TAX ID -->
    <input type="number" name="taxid" placeholder="Adó Azonosító" class="form-input mx-auto" required />
    <!-- SOCIAL SECURITY NUMBER -->
    <input type="number" name="ssn" placeholder="TAJ Szám" class="form-input mx-auto" required />
    <!-- BANK -->
    <input type="text" name="bankacc" placeholder="Bankszámla Szám" class="form-input mx-auto" required />
    <!-- GROSS WAGE -->
    <input type="number" name="wage" placeholder="Bruttó Bér" class="form-input mx-auto" required />
    <!-- POSITION -->
    <label class="form-input-label" for="position">Munkakör</label>
    <select id="position" name="position" class="form-input" style="margin-top: 5px;">
      <?php
      foreach ($positions as $position) {
        echo '<option value=' . $position["id"] . '>' . $position["name"] . '</option>';
      }
      ?>
    </select>
    <!-- DEPARTMENT -->
    <label class="form-input-label" for="department">Szervezeti Egység</label>
    <select name="department" class="form-input" style="margin-top: 5px;">
      <?php
      foreach ($departments as $department) {
        echo '<option value=' . $department["id"] . '>' . $department["name"] . '</option>';
      }
      ?>
    </select>
    <!-- SUBMIT -->
    <button type="submit" name="submit" class="button form-control">Rendben</button>
  </form>
</div>

<script>
  const validateBank = (bank) => {
    let regex = /^(-*[0-9]{8}-*){2,3}$/;

    if (!bank.match(regex)) {
      alert("A bankszámlaszám nem helyes");
      return false;
    }
    let num = bank.replace(/-/g, "").split("");

    let odd = 0;
    let even = 0;
    let cdv = num.slice(-1);
    num = num.slice(0, -2);
    num.reverse().map((item, index) => (index % 2 === 0) ? odd += parseInt(item) : even += parseInt(item));
    odd = odd * 3;
    if (!((10 - ((odd + even) % 10)) % 10 == cdv)) {
      return false;
    }
    return true;
  };

  const validateSocialSecurityNumber = (ssn) => {
    if (ssn.length !== 9) {
      return false;
    }
    return true;
  }

  const validateTaxId = (taxid) => {
    if (ssn.length !== 10) {
      return false;
    }
    return true;
  }

  const validateName = (name) => {
    //dont even start me on this
    //regex for names around europe with umlauts dots commas apostrophes and all the weird french nordic and slavic characters
    let regex = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u;

    if (!name.match(regex)) {
      return false;
    }
    return true;
  }

  function validateForm() {
    let bank = document.forms["create"]["bankacc"].value;
    let ssn = document.forms["create"]["ssn"].value;
    let taxid = document.forms["create"]["taxid"].value;

    if (validateBank(bank)) {
      alert("A bankszámlaszám nem helyes");
      return false;
    }
    if (validateSocialSecurityNumber(ssn)) {
      alert("A TAJ szám nem helyes");
      return false;
    }
    if (validateTaxId(taxid)) {
      alert("Az adóazonosító nem helyes");
      return false;
    }
    if (validateName()) {
      alert("A név nem tartalmazhat extra különleges karaktereket (pl.: $) és számokat");
      return false;
    }
    alert("sent");

    return false;
  }
</script>

<?php
include_once '../../shared/footer.php';
?>