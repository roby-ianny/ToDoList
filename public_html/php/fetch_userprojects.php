<?php
require_once './tasksfunctions.php';

session_start();

// Controllo la sessione
include './checksession.php';

$con = db_connection();

// Query per selezionare i progetti dll'utente
$stmt = $con->prepare("
  SELECT 
    p.id AS ProjectId, 
    p.Creator AS ProjectCreator,
    p.Name AS ProjectName
  FROM 
    Projects p 
  JOIN 
    Users u on p.Creator = u.id
  WHERE
    p.Creator = ?;
  ");

$userid = $_SESSION['session_user'];
$stmt->bind_param('i', $userid);
if(!($stmt->execute())){
  $stmt->close();
  $con->close();
  header('location ../error.php');
}
$result = $stmt->get_result();
$projects = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $projects[] = $row;
  }
} else {
  $stmt->close();
  $con->close();
  $projects = [];
  echo json_encode($projects);
  exit();
}
// Chiudo statement e connessione
$stmt->close();
$con->close();

// Ritorno i dati con un json
header('Content-Type: application/json');
echo json_encode($projects);
exit();
?>
