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

$query = 'UPDATE workers SET pos_id = ?, dep_id = ?, name = ?, grosswage = ?, taxid = ?, ssn = ?, ban = ? WHERE id = ?;';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "iisisssi", $pos_id, $dep_id, $name, $wage, $taxid, $ssn, $ban, $id);

try {
  mysqli_stmt_execute($statement);
  if (mysqli_stmt_affected_rows($statement) === 0) {
    throw new Exception("No data was modified");
  }
} catch (Exception $error) {
  echo $error;
  exit();
} finally {
  mysqli_stmt_close($statement);
}

header('location: ../index.php?msg=addsuccess');
