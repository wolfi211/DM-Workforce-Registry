<?php

if (!isset($_POST["submit"])) {
  header('location: ../');
  exit();
}

$name = $_POST["name"];
$description = $_POST["description"];

include_once '../../utils/dbconn.php';
include_once '../../utils/flog.php';

$query = 'INSERT INTO positions (name, description) VALUES (?, ?);';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "ss", $name, $description);

try {
  mysqli_stmt_execute($statement);
  if (mysqli_stmt_affected_rows($statement) === 0) {
    header('location: ../index.php?msg=adderror');
    echo '<script>console.log("No rows were created")</script>';
    exit();
  }
  flog("inserted into positions => " . $name);
} catch (Exception $error) {
  header('location: ../index.php?msg=adderror');
  echo '<script>console.log("Error during position create")</script>';
  exit();
} finally {
  mysqli_stmt_close($statement);
}

header('location: ../index.php?msg=addsuccess');
