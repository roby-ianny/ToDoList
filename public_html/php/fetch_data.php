<?php
session_start();

require_once './tasksfunctions.php';

$con = db_connection();

// SQL query to select data
$stmt = $con->prepare(
  "
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
        p.Creator = ?; 
  "
);
$userid = $_SESSION['session_user'];
$stmt->bind_param('i', $userid);
if(!($stmt->execute())){
  $stmt->close();
  $con->close();
  header('location: ../error.php');
}
$result = $stmt->get_result();

$data = array();

if ($result->num_rows > 0) {
    // Fetch all results into an array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
  $data[] = $userid;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode(['data' => $data]);


// Close the connection
$stmt->close();
$con->close();
?>
