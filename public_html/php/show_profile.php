<?php
require_once './tasksfunctions.php';
session_start();

// Controllo la sessione
include './checksession.php';

$con = db_connection();
$stmt = $con->prepare("
  SELECT 
    Firstname,
    Lastname,
    Email,
    Info
  FROM 
    Users
  WHERE
    id = ?
  ");

$userid = $_SESSION['session_user'];
$stmt->bind_param('i', $userid);
if (!($stmt->execute())) {
  $stmt->close();
  $con->close();
  echo json_encode(['success' => false, 'message' => 'Error executing query.']);
  exit();
}

$result = $stmt->get_result();
$data = array();
if ($result->num_rows > 0) {
  $result = $result->fetch_assoc();
  $firstname = $result['Firstname'];
  $lastname = $result['Lastname'];
  $email = $result['Email'];
  $info = $result['Info'];
  $data = array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'info' => $info);
} else {

  $stmt->close();
  $con->close();
  echo json_encode(['success' => false, 'message' => 'Error executing query.']);
  exit();
}

$stmt->close();
$con->close();

// Ritorno i dati come json
header('Content-Type: application/json');
echo json_encode(['success' => true, 'data' => $data]);
exit();
