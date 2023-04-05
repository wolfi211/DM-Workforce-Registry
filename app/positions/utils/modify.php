<?php
if (!isset($_POST["submit"])) {
  header('location: ../');
  exit();
}

$id = $_POST["id"];
$name = $_POST["name"];
$description = $_POST["description"];

include_once '../../utils/dbconn.php';
include_once '../../utils/flog.php';

$query = 'UPDATE positions SET name = ?, description = ? WHERE id = ?;';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "ssi", $name, $description, $id);

try {
  mysqli_stmt_execute($statement);
  if (mysqli_stmt_affected_rows($statement) === 0) {
    header('location: ../index.php?msg=moderror');
    echo '<script>console.log("No rows were modified")</script>';
    exit();
  }
  flog("updated positions => " . $id . " to " . $name);
} catch (Exception $error) {
  header('location: ../index.php?msg=moderror');
  echo '<script>console.log("Error during position update")</script>';
  exit();
} finally {
  mysqli_stmt_close($statement);
}

header('location: ../index.php?msg=modsuccess');
