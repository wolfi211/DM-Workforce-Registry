<?php
if (!isset($_POST["submit"])) {
  header('location: ../');
  exit();
}

$id = $_POST["id"];

include_once '../../utils/dbconn.php';
include_once '../../utils/flog.php';

$query = 'DELETE FROM workers WHERE id = ?;';

$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  exit();
}

mysqli_stmt_bind_param($statement, "i", $id);

try {
  mysqli_stmt_execute($statement);
  if (mysqli_stmt_affected_rows($statement) === 0) {
    header('location: ../index.php?msg=delerror');
    echo '<script>console.log("No rows were modified")</script>';
    exit();
  }
} catch (Exception $error) {
  header('location: ../index.php?msg=delerror');
  echo '<script>console.log("Error during worker remove")</script>';
  exit();
} finally {
  mysqli_stmt_close($statement);
}

header('location: ../index.php?msg=delsuccess');
