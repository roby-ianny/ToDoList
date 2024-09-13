<?php
function db_connection()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "todolist";

  try {
    $con = new mysqli($servername, $username, $password, $dbname);

    if ($con->connect_error) {
      throw new Exception("Errore di connessione al Database: " . $con->connect_error);
    }

    return $con;
  } catch (Throwable $e) {
    echo "Errore: " . $e->getMessage();
    $con->close();
    header("Location: error.php");
    return false;
  }
}

// funzione che controlla il proprietario del task
function check_task_owner(mysqli $con, int $task_id)
{
  session_start();

  $stmt = $con->prepare("
    SELECT 
      u.id AS UserId,
      t.id AS TaskId
    FROM
      Tasks t
    JOIN
      Projects p ON t.Project = p.id
    JOIN
      Users u ON p.Creator = u.id
    WHERE
      t.id = ?
    ");

  $stmt->bind_param('i', $task_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  $con->close();
  if ($result->num_rows === 0) {
    return false;
  } else {
    $result = $result->fetch_assoc();
    if ($result['UserId'] !== $_SESSION['session_user'] || $result['TaskId'] !== $task_id) {
      return false;
    }
  }

  return true;
}

function check_project_owner(mysqli $con, $project_id)
{
  session_start();

  $stmt = $con->prepare("
    SELECT 
      u.id AS UserId,
      p.id AS ProjectId 
    FROM
      Projects p
    JOIN
      Users u ON p.Creator = u.id
    WHERE
      p.id = ?
    ");

  $stmt->bind_param('i', $project_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  $con->close();
  if ($result->num_rows === 0) {
    return false;
  } else {
    $result = $result->fetch_assoc();
    if ($result['UserId'] !== $_SESSION['session_user'] || $result['ProjectId'] !== $project_id) {
      return false;
    }
  }
  return true;
}

function isValidDate($date, $format)
{
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) === $date;
}
