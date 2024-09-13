<?php

session_start();

require_once './tasksfunctions.php';

$taskId = (isset($_POST['id']) && is_numeric($_POST['id'])) ? intval($_POST['id']) : null;

if (!($taskId) || $taskId < 0) {
  echo json_encode(['success' => false, 'message' => 'Invalid input.']);
  exit();
}

$con = db_connection();
// controllo se il task appartiene all'utente usando la sessione
if (!(check_task_owner(db_connection(), $taskId))){
  echo json_encode(['success' => false, 'message' => 'Invalid input.']);
  exit();
}

$stmt = $con->prepare("DELETE FROM Tasks WHERE id = ?");
$stmt->bind_param('i', $taskId);
if ($stmt->execute()) {
  echo json_encode(['success' => true, 'message' => 'Task deleted successfully.']);
} else {
  echo json_encode(['success' => false, 'message' => 'Error deleting task.']);
}

$stmt->close();
$con->close();
