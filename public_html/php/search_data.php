<?php
session_start();
require_once './tasksfunctions.php';
$con = db_connection();

// Controllo il tipo di richiesta e sanifico l'input
if ($_SERVER["REQUEST_METHOD"] != "GET") {
  $data[] = null;
  header("Content-Type: application/json");
  echo json_encode(["data" => $data]);
  exit;
}

$search = isset($_GET["search"]) ? trim(htmlspecialchars($_GET["search"], ENT_SUBSTITUTE, null)) : null;

if ($search == null) {
  // Se il parametro di ricerca è nullo allora ricerco la stringa vuota
  $search = "";
}

// Query che utilizza LIKE per la ricerca
$stmt = $con->prepare("
  SELECT 
    t.id AS id,
    t.Name AS TaskName,
    t.Creation AS TaskCreation,
    t.Due AS TaskDue,
    t.Recurrency AS TaskRecurrency,
    t.Done AS TaskDone,
    t.Notes AS TaskNotes,
    p.Name AS ProjectName  
  FROM 
    Tasks t
  JOIN 
    Projects p ON t.Project = p.id
  WHERE
    ( p.Creator = ?
  AND (
    t.Name LIKE ?
  OR
    p.Name LIKE ?
  OR
    t.Notes LIKE ?
  ))
  ");
$userid = $_SESSION['session_user'];
$stmt->bind_param("isss", $userid, $search, $search, $search);

if (!($stmt->execute())) {
  $stmt->close();
  $con->close();
  $data[] = null;
  header("Content-Type: application/json");
  echo json_encode(["data" => $data]);
  exit();
}

$result = $stmt->get_result();
$data = array();
if ($result->num_rows > 0) {
  // Fetch all results into an array
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} else {
  $data[] = [];
}

// Ritorno il risultato della ricerca in json
header("Content-Type: application/json");
echo json_encode(["data" => $data]);

// Chiudo la connessione
$stmt->close();
$con->close();
exit();
?>
