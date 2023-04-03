<?php

if (!isset($_POST["submit"])) {
  header('location: ../');
  exit();
}

$name = $_POST["name"];
$pos_id = $_POST["position"];
$dep_id = $_POST["department"];
$ssn = $_POST["ssn"];
$taxid = $_POST["taxid"];
$ban = $_POST["ban"];
$wage = $_POST["wage"];

include_once '../../utils/dbconn.php';

$query = 'INSERT INTO workers (pos_id, dep_id, name, grosswage, taxid, ssn, ban) VALUES (?, ?, ?, ?, ?, ?, ?);';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "iisisss", $pos_id, $dep_id, $name, $wage, $taxid, $ssn, $ban);

try {
  mysqli_stmt_execute($statement);
  if (mysqli_stmt_affected_rows($statement) === 0) {
    throw new Exception("No data was added");
  }
} catch (Exception $error) {
  echo $error;
  exit();
} finally {
  mysqli_stmt_close($statement);
}

header('location: ../index.php?msg=addsuccess');
