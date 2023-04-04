<?php
function getWorkers($conn)
{
  $query = 'SELECT * FROM workers ORDER BY name ASC;';

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

function getWorkerById($conn, $id)
{
  $query = 'SELECT * FROM workers WHERE id=?;';

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
