<?php
function getPositions($conn)
{
  $query = 'SELECT * FROM positions;';

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

function getPositionById($conn, $id)
{
  require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/dbconn.php';

  $query = 'SELECT * FROM positions WHERE id=?;';

  $statement = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($statement, $query)) {
    exit();
  }

  mysqli_stmt_bind_param($statement, "i", $id);

  try {
    mysqli_stmt_execute($statement);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($statement));
  } catch (Exception $error) {
    echo $error;
    exit();
  } finally {
    mysqli_stmt_close($statement);
  }

  return $result;
}
