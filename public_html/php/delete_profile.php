<?php

session_start();

require_once './tasksfunctions.php';

// Controllo se la richiesta è una POST 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
  exit();
}

$userid = (isset($_SESSION['session_user']) && is_numeric($_SESSION['session_user'])) ? intval($_SESSION['session_user']) : null;

if (!($userid) || $userid < 0) {
  echo json_encode(['success' => false, 'message' => 'Invalid userid.']);
  exit();
}

$con = db_connection();
// controllo se il task appartiene all'utente usando la sessione

$stmt = $con->prepare("DELETE FROM Users WHERE id = ?");
$stmt->bind_param('i', $userid);
if ($stmt->execute()) {
  $stmt->close();
  $con->close();
  echo json_encode(['success' => true, 'message' => 'Invalid input.']);
  exit();
} else {
  $stmt->close();
  $con->close();
  echo json_encode(['success' => false, 'message' => 'Database Error']);
  exit();
}
