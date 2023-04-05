<?php
if (!isset($_POST["id"])) {
  header('location: ../');
  exit();
}

$id = $_POST["id"];
$name = $_POST["name"];

include_once '../../utils/dbconn.php';
include_once '../../utils/flog.php';

$query = 'UPDATE departments SET name = ? WHERE id = ?;';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "si", $name, $id);

try {
  mysqli_stmt_execute($statement);
  if (mysqli_stmt_affected_rows($statement) === 0) {
    header('location: ../index.php?msg=moderror');
    echo '<script>console.log("No rows were modified")</script>';
    exit();
  }
  flog("updated departments => " . $id . " to " . $name);
} catch (Exception $error) {
  header('location: ../index.php?msg=moderror');
  echo '<script>console.log("Error during department update")</script>';
  exit();
} finally {
  mysqli_stmt_close($statement);
}

header('location: ../index.php?msg=modsuccess');
