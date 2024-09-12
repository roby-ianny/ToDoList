<?php
require_once("./tasksfunctions.php");
session_start();

if ($_SERVER["REQUEST_METHOD"]!="POST"){
  header("location: ../error.php");
  exit;
}

// Verifica della presenza dei valori e assegnazione delle variabili
$taskId = isset($_POST['task_id']) ? intval($_POST['task_id']) : header('location: ../error.php');
$taskName = isset($_POST['task_name']) ? trim(htmlspecialchars($_POST['task_name'], ENT_SUBSTITUTE, null)) : header('location: ../error.php');
$taskDue = isset($_POST['task_due']) ? trim($_POST['task_due']) : null;
$taskRecurrency = isset($_POST['task_recurrency']) ? intval($_POST['task_recurrency']) : null;
$taskStatus = isset($_POST['task_status']) ? intval($_POST['task_status']) : header('location: ../error.php');
$taskNotes = isset($_POST['task_notes']) ? trim(htmlspecialchars($_POST['task_notes'])) : "";
$taskProject = isset($_POST['task_project']) ? trim(htmlspecialchars($_POST['task_project'], ENT_SUBSTITUTE, null)) : header('location: ../error.php');


// Controllo se il task appartiene all'utente usando la sessione
if (!check_task_owner(db_connection(), $taskId)){
  header("location: ../error.php");
  exit();
}

// Controllo se la data è valida e la nullo nel caso non lo fosse
if (!(isValidDate($taskDue, "Y-m-d"))) {
 $taskDue = null; 
}

// Se la recurrency è 0 o negativa allora la nullo
$taskRecurrency = ($taskRecurrency > 0) ? $taskRecurrency : null ;

// Eseguo la query
$con = db_connection();
$stmt = $con->prepare("
  UPDATE Tasks 
  SET 
    Name = ?, 
    Due = ?, 
    Recurrency = ?, 
    Done = ?, 
    Notes = ?, 
    Project = ? 
  WHERE 
    id = ?
  ");
$stmt->bind_param('ssiisii', $taskName, $taskDue, $taskRecurrency, $taskStatus, $taskNotes, $taskProject, $taskId);
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
