<?php
function getDepartments()
{
  require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/dbconn.php';

  $query = 'SELECT * FROM departments;';

  $statement = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($statement, $query)) {
    exit();
  }

  try {
    mysqli_stmt_execute($statement);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($statement), MYSQLI_ASSOC);
  } catch (Exception $error) {
    echo $error;
    exit();
  } finally {
    mysqli_stmt_close($statement);
  }

  return $result;
}
