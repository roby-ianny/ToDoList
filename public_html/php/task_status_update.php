<?php
require_once("./tasksfunctions.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $taskId = isset($_POST['id']) ? intval($_POST['id']) : header('location: ../error.php');
  $status = isset($_POST['status']) ? $_POST['status'] : header('location: ../error.php');

  // verifico di avere dei valori sensati
  if (!($taskId > 0 && ($status === 'done' || $status === 'not-done'))) {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
  }

  // se il tasks viene segnato come "fatto" allora è 1 e se non è stato fatto allora è 0
  $status = ($status === 'done') ? 0 : 1;

  $con = db_connection();
  // controllo se il task appartiene all'utente usando la sessione
  if (!(check_task_owner(db_connection(), $taskId))) {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    exit();
  }

  // controllo se il task è ricorrente
  $stmt = $con->prepare("SELECT Due, Recurrency FROM Tasks WHERE id = ?");
  $stmt->bind_param('i', $taskId);
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $due = new DateTime($row['Due']);
    $recurrency = $row['Recurrency'];
    if (($recurrency <= 0) || is_null($recurrency)) {
      $stmt = $con->prepare("UPDATE Tasks SET Done = ? WHERE id = ?");
      $stmt->bind_param('ii', $status, $taskId);
      if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Task updated successfully.', 'status' => $status, 'id' => $taskId]);
      } else {
        echo json_encode([' success' => false, 'message' => 'Erorr updating tasks.', 'status' => $status, 'id' => $taskId]);
      }
    } else {
      $due->modify("+$recurrency days");
      $due = $due->format('Y-m-d');
      $stmt = $con->prepare("UPDATE Tasks SET Due = ? WHERE id = ?");
      $stmt->bind_param('si', $due, $taskId);
      if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Task updated successfully.', 'status' => $status, 'id' => $taskId]);
      } else {
        echo json_encode([' success' => false, 'message' => 'Erorr updating tasks.', 'status' => $status, 'id' => $taskId]);
      }
    }
  } else {
    echo json_encode([' success' => false, 'message' => 'Erorr updating tasks.', 'status' => $status, 'id' => $taskId]);
  }


  $stmt->close();
  $con->close();
}
