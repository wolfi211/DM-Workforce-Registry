<?php

if (!isset($_POST["submit"])) {
  header('location: ../');
  exit();
}

$id = $_POST["id"];
$name = $_POST["name"];
$pos_id = $_POST["position"];
$dep_id = $_POST["department"];
$ssn = $_POST["ssn"];
$taxid = $_POST["taxid"];
$ban = $_POST["ban"];
$wage = $_POST["wage"];

include_once '../../utils/dbconn.php';
include_once '../../utils/flog.php';

$query = 'UPDATE workers SET pos_id = ?, dep_id = ?, name = ?, grosswage = ?, taxid = ?, ssn = ?, ban = ? WHERE id = ?;';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "iisisssi", $pos_id, $dep_id, $name, $wage, $taxid, $ssn, $ban, $id);

try {
  mysqli_stmt_execute($statement);
  if (mysqli_stmt_affected_rows($statement) === 0) {
    header('location: ../index.php?msg=moderror');
    echo '<script>console.log("No rows were modified")</script>';
    exit();
  }
  flog("updated workers => " . $id . " to " . $name);
} catch (Exception $error) {
  header('location: ../index.php?msg=moderror');
  echo '<script>console.log("Error during worker update")</script>';
  exit();
} finally {
  mysqli_stmt_close($statement);
}

header('location: ../index.php?msg=addsuccess');
