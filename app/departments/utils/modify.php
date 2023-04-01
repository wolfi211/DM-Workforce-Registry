<?php
if (!isset($_POST["id"])) {
  header('location: ../');
  exit();
}

$id = $_POST["id"];
$name = $_POST["name"];

include_once '../../utils/dbconn.php';

$query = 'UPDATE departments SET name = ? WHERE id = ?;';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "si", $name, $id);

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

header('location: ../index.php?msg=modsuccess');
