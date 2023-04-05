<?php
include_once '../shared/header.php';
?>

<?php
include_once '../utils/dbconn.php';
include_once './utils/workforce.php';
include_once '../departments/utils/departments.php';
include_once '../positions/utils/positions.php';

$workers = getWorkers($conn);

$banks = array(
  "107" => "CIB Bank",
  "116" => "Erste Bank",
  "109" => "UniCredit Bank",
  "190" => "Magyar Nemzeti Bank",
  "117" => "OTP Bank",
  "120" => "Raiffeisen Bank",
);

if (isset($_GET["sort"]) && isset($_GET["direction"])) {
  $sort = $_GET["sort"];
  $dir = $_GET["direction"];
  if ($sort === "name" && $dir === "asc") {
    usort($workers, function ($worker1, $worker2) {
      return $worker1["name"] <=> $worker2["name"];
    });
  } else if ($sort === "name" && $dir === "desc") {
    usort($workers, function ($worker1, $worker2) {
      return $worker2["name"] <=> $worker1["name"];
    });
  } else if ($sort === "wage" && $dir === "asc") {
    usort($workers, function ($worker1, $worker2) {
      return $worker1["grosswage"] <=> $worker2["grosswage"];
    });
  } else if ($sort === "wage" && $dir === "desc") {
    usort($workers, function ($worker1, $worker2) {
      return $worker2["grosswage"] <=> $worker1["grosswage"];
    });
  } else if ($sort === "ban" && $dir === "asc") {
    usort($workers, function ($worker1, $worker2) {
      return $worker1["ban"] <=> $worker2["ban"];
    });
  } else if ($sort === "ban" && $dir === "desc") {
    usort($workers, function ($worker1, $worker2) {
      return $worker2["ban"] <=> $worker1["ban"];
    });
  }
}

?>

<div class="sorting mx-auto my-10">
  <?php
  if (
    isset($_GET["sort"])
    && (
      ($_GET["sort"] == "name"
        && isset($_GET["direction"])
        && $_GET["direction"] == "desc"
      )
      || $_GET["sort"] != "name"
    )
  ) {
    echo '<a href="./index.php?sort=name&direction=asc" class="button">Név Szerint</a>';
  } else {
    echo '<a href="./index.php?sort=name&direction=desc" class="button">Név Szerint</a>';
  }
  if (
    isset($_GET["sort"])
    && $_GET["sort"] == "wage"
    && isset($_GET["direction"])
    && $_GET["direction"] == "asc"
  ) {
    echo '<a href="./index.php?sort=wage&direction=desc" class="button">Bér szerint</a>';
  } else {
    echo '<a href="./index.php?sort=wage&direction=asc" class="button">Bér szerint</a>';
  }
  if (
    isset($_GET["sort"])
    && $_GET["sort"] == "ban"
    && isset($_GET["direction"])
    && $_GET["direction"] == "asc"
  ) {
    echo '<a href="./index.php?sort=ban&direction=desc" class="button">Bank szerint</a>';
  } else {
    echo '<a href="./index.php?sort=ban&direction=asc" class="button">Bank szerint</a>';
  }
  ?>
</div>

<a href="./create" class="button w-500 mx-auto my-10">Új Hozzáadása</a>


<?php
$prevbank = substr($workers[0]["ban"], 0, 3);
if (isset($sort) && $sort == "ban") {
  echo '<h2 class="ta-center">' . $banks[$prevbank] . '</h2>';
}
echo '<div class="box mx-auto">';
foreach ($workers as $worker) {
  if (isset($sort) && $sort == "ban" && substr($worker["ban"], 0, 3) !== $prevbank) {
    $prevbank = substr($worker["ban"], 0, 3);
    echo '</div><hr />' . '<h2 class="ta-center">' . $banks[$prevbank] . '</h2>' . '<div class="box mx-auto">';
  }
  echo '<div class="card">' .
    '<h3 class="ta-center">' . $worker['name'] . '</h3>' .
    '<p class="ta-center card-item h-60">' .
    '<span class="mx-10 fl">Munkakör:</span>' .
    '<br />' .
    '<span class="mx-20 fr">' . getPositionById($conn, $worker['pos_id'])['name'] . '</span>' .
    '</p>' .
    '<hr />' .
    '<p class="ta-center card-item h-60">' .
    '<span class="mx-10 fl">Sz.E.:</span>' .
    '<br />' .
    '<span class="mx-20 fr">' . getDepartmentById($conn, $worker['dep_id'])['name'] . '</span>' .
    '</p>' .
    '<hr />' .
    '<p class="ta-center card-item">' .
    '<span class="mx-10 fl">TAJ:</span>' .
    '<span class="mx-20 fr">' . $worker['ssn'] . '</span>' .
    '</p>' .
    '<hr />' .
    '<p class="ta-center card-item">' .
    '<span class="mx-10 fl">Adó Az.:</span>' .
    '<span class="mx-20 fr">' . $worker['taxid'] . '</span>' .
    '</p>' .
    '<hr />' .
    '<p class="ta-center card-item">' .
    '<span class="mx-10 fl">Bankszámla:</span>' .
    '<br />' .
    '<span class="mx-20 fr">' . $worker['ban'] . '</span>' .
    '</p>' .
    '<hr />' .
    '<p class="ta-center card-item">' .
    '<span class="mx-10 fl">Bruttó Bér:</span><span class="mx-20 fr">' . $worker['grosswage'] . ' Ft</span>' .
    '</p>' .
    '<form action="./modify/index.php" method="POST" class="my-5">' .
    '<input type="hidden" name="id" value="' . $worker['id'] . '" />' .
    '<button type="submit" name="submit" class="button form-control">Módosít</button>' .
    '</form>' .
    '<form action="./utils/remove.php" method="POST" class="my-5">' .
    '<input type="hidden" name="id" value="' . $worker['id'] . '" />' .
    '<button type="submit" name="submit" class="button form-control">Töröl</button>' .
    '</form>' .
    '</div>';
}
echo '</div>';
?>


<?php
include_once '../shared/footer.php';
?>