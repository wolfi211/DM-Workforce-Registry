<?php
include_once '../../shared/header.php';
?>

<?php
include_once '../../utils/dbconn.php';
include_once '../../departments/utils/departments.php';
include_once '../../positions/utils/positions.php';
$departments = getDepartments($conn);
$positions = getPositions($conn);
$_
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
    <input type="text" name="ban" placeholder="Bankszámla Szám" class="form-input mx-auto" required />
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
  function validateForm() {
    let ban = document.forms["create"]["ban"].value;
    let ssn = document.forms["create"]["ssn"].value;
    let taxid = document.forms["create"]["taxid"].value;
    let name = document.forms["create"]["name"].value;

    if (!validateBank(ban)) {
      //alert("A bankszámlaszám nem helyes");
      return false;
    }
    if (!validateSSN(ssn)) {
      alert("A TAJ szám nem helyes");
      return false;
    }
    if (!validateTaxId(taxid)) {
      alert("Az adóazonosító nem helyes");
      return false;
    }
    if (!validateName(name)) {
      alert("A név nem tartalmazhat extra különleges karaktereket (pl.: $) és számokat");
      return false;
    }

  }

  function validateBank(value) {
    if (!checkBANregex(value)) {
      console.error("BAN format not valid");
      alert("A bankszámlaszám nem helyes formátumú");
      return false;
    }
    let ban = value.split("-");
    let ban1 = ban[0];
    let ban2 = ban[1] + ((ban.length === 3) ? ban[2] : "");

    if (!checkBanValidity(ban1) || !checkBanValidity(ban2)) {
      console.error("ban not valid");
      alert("A bankszámlaszám nem érvényes");
      return false;
    }
    return true;
  }

  function validateSSN(ssn) {
    if (ssn.length !== 9) {
      return false;
    }
    return true;
  }

  function validateTaxId(taxid) {
    if (taxid.length !== 10) {
      return false;
    }
    return true;
  }

  function validateName(name) {
    //dont even start me on this
    //regex for names around europe with umlauts dots commas apostrophes and all the weird french nordic and slavic characters
    let regex = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u;

    if (!name.match(regex)) {
      return false;
    }
    return true;
  }

  function getBanCdv(ban) {
    let check = [9, 7, 3, 1];
    let sum = 0;
    ban.split("").map((num, index) => {
      sum += check[index % 4] * parseInt(num);
    });
    let cdv = (10 - (sum % 10)) % 10;
    return cdv;
  }

  function checkBanValidity(ban) {
    let cdv = ban.slice(-1);
    let ccdv = getBanCdv(ban.slice(0, -1));
    return ccdv == parseInt(cdv);
  }

  function checkBANregex(ban) {
    let rgx1 = /^[0-9]{8}-{1}[0-9]{8}$/;
    let rgx2 = /^[0-9]{8}-{1}[0-9]{8}-{1}[0-9]{8}$/;
    return (ban.match(rgx1) || ban.match(rgx2)) ? true : false;
  }
</script>

<?php
include_once '../../shared/footer.php';
?>