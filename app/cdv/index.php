<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/shared/header.php';
?>
<div class="mx-auto" style="width:500px;">
  <input id="number" class="form-input" type="text" />
  <button id="calcCDV" type="button" class="button form-control my-10">Calc CDV</button>
  <button id="testCDV" type="button" class="button form-control my-10">Test CDV</button>
  <button id="genBAN" type="button" class="button form-control my-10">Generate BAN</button>

  <h2 id="ban" class="mx-auto fit-content"></h2>
</div>

<script>
  document.getElementById("calcCDV").addEventListener("click", () => {
    let value = document.getElementById("number").value;
    // /^([0-9]{7})((-{1}[0-9]{7}$)|(-{1}[0-9]{8}-{1}[0-9]{7}$))/
    let rgx1 = /^[0-9]{7}-{1}[0-9]{8}-{1}[0-9]{7}$/
    let rgx2 = /^[0-9]{7}-{1}[0-9]{7}$/
    if (!(value.match(rgx1) || value.match(rgx2))) {
      console.log("the ban is not the correct format for cdv calculation");
      return false;
    }
    let ban = value.split("-");
    let ban1 = ban[0];
    let ban2 = ban[1] + ((ban.length === 3) ? ban[2] : "");

    ban = ban1 + getBanCdv(ban1) + "-" + ban2 + getBanCdv(ban2);
    console.log("cdv for 1st part: " + getBanCdv(ban1));
    console.log("cdv for 2nd part: " + getBanCdv(ban2));
    document.getElementById("ban").innerHTML = ban;
  });

  document.getElementById("testCDV").addEventListener("click", () => {
    let value = document.getElementById("number").value;
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
  });

  document.getElementById("genBAN").addEventListener("click", () => {
    console.log("clicked");
    document.getElementById("ban").innerHTML = generateBan();
  });

  function getBanCdv(ban) {
    let checkA = [9, 7, 3, 1];
    let sum = 0;
    ban.split("").map((num, index) => {
      sum += checkA[index % 4] * parseInt(num);
    });
    let ccdv = (10 - (sum % 10)) % 10;
    return ccdv;
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

  function generateSubBAN(len = 8, bank = "") {
    let ban = bank;
    let start = bank.length;

    for (let i = start; i < len - 1; i++) {
      ban += getRandom(10).toString();
    }
    ban += getBanCdv(ban);
    return ban;
  }

  function generateBan() {
    return ((Math.random() < 0.75) ? generateShortBan() : generateLongBan());
  }

  function generateShortBan() {
    ban = generateSubBAN(8, getRandomBank()) + "-" + generateSubBAN();
    return ban;
  }

  function generateLongBan() {
    ban2 = generateSubBAN(16);
    ban = generateSubBAN(8, getRandomBank()) + "-" + ban2.slice(0, 8) + "-" + ban2.slice(8);
    return ban;
  }

  function getRandomBank() {
    banks = ["107", "116", "109", "190", "117", "120"];
    return banks[getRandom(6)];
  }

  function getRandom(max) {
    return Math.floor(Math.random() * max);
  }
</script>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/shared/footer.php';
?>