<?php

require_once("./tasksfunctions.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("location: ../error.php");
  exit;
}


// Verifica e sanitizzazione dell'input
$taskName = isset($_POST['add_task_name']) ? trim(htmlspecialchars($_POST['add_task_name'], ENT_SUBSTITUTE, null)) : header('location: ../error.php');
$taskDue = isset($_POST['add_task_due']) ? trim($_POST['add_task_due']) : null;
$taskRecurrency = isset($_POST['add_task_recurrency']) ? intval($_POST['add_task_recurrency']) : null;
$taskStatus = (isset($_POST['add_task_status']) && is_numeric($_POST['add_task_status'])) ? intval($_POST['add_task_status']) : header('location: ../error.php');
$taskNotes = isset($_POST['add_task_notes']) ? trim(htmlspecialchars($_POST['add_task_notes'])) : "";
$taskProject = (isset($_POST['add_task_project']) && is_numeric($_POST['add_task_project'])) ? intval($_POST['add_task_project']) : header('location: ../error.php');


// Controllo se la data è valida e la nullo nel caso non lo fosse
if (!(isValidDate($taskDue, "Y-m-d"))) {
  $taskDue = null;
}

// Se la recurrency è 0 o negativa allora la nullo
$taskRecurrency = ($taskRecurrency > 0) ? $taskRecurrency : null;

// Controllo se $taskStatus è 0 o 1 
if($taskStatus < 0 || $taskStatus > 1) {
  header("location: ../error.php");
  exit();
}

// Controllo se il progetto appartiene all'utente
if (!(check_project_owner(db_connection(), $taskProject))) {
  header("location: ../error.php");
  exit();
}

// Eseguo la query
$con = db_connection();
$stmt = $con->prepare("
  INSERT INTO Tasks
    (Name, Creation, Due, Recurrency, Done, Notes, Project)
  VALUES
    (?, NOW(), ?, ?, ?, ?, ?)
  ");
$stmt->bind_param('ssiisi', $taskName, $taskDue, $taskRecurrency, $taskStatus, $taskNotes, $taskProject); 
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
