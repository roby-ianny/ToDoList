<?php
session_start();

require_once("./tasksfunctions.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("location: ../error.php");
  exit;
}

// Verifica e sanitizzazione dell'input
$projectName = isset($_POST['add_project_name']) ? htmlspecialchars(trim($_POST['add_project_name']), ENT_SUBSTITUTE, null) : header('location: ../error.php');

// Mi connetto al DB:
$con = db_connection();

// Controllo che non esista un progetto con lo stesso nome
$stmt = $con->prepare("
  SELECT * 
  FROM Projects 
  JOIN Users on Projects.Creator = Users.Id
  WHERE Name = ? AND Projects.Creator = ?
  ");
$userid = $_SESSION['session_user'];
$stmt->bind_param('si', $projectName, $userid);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $stmt->close();
  $con->close();
  $_SESSION["errors"] = "Hai un progetto con lo stesso nome";
  header("location: ../dashboard.php");
  exit();
}

// Inserisco il progetto nel DB
$stmt = $con->prepare("
  INSERT INTO Projects (Name, Creator) VALUES (?, ?)
  ");
$userid = $_SESSION['session_user'];
$stmt->bind_param('si', $projectName, $userid);
if ($stmt->execute()) {
  $stmt->close();
  $con->close();
  header("location:  ../dashboard.php");
} else {
  $stmt->close();
  $con->close();
  header("location:  ../error.php");
}

exit();
