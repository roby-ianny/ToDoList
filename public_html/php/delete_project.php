<?php

session_start();

require_once './tasksfunctions.php';

// Controllo se la richiesta è una POST 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
  exit();
}

$projectId = (isset($_POST['delete_project_id']) && is_numeric($_POST['delete_project_id'])) ? intval($_POST['delete_project_id']) : null;

if (!($projectId) || $projectId < 0) {
  echo json_encode(['success' => false, 'message' => 'Invalid input.']);
  exit();
}

$con = db_connection();
// controllo se il task appartiene all'utente usando la sessione
if (!(check_project_owner(db_connection(), $projectId))) {
  header("location: ../error.php");
  exit();
}

$stmt = $con->prepare("DELETE FROM Projects WHERE id = ?");
$stmt->bind_param('i', $projectId);
if ($stmt->execute()) {
  $stmt->close();
  $con->close();
  header("location: ../dashboard.php");
  exit();
} else {
  $stmt->close();
  $con->close();
  header("location: ../error.php");
  exit();
}
