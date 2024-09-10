<?php
session_start();

include './tasksfunctions.php';

$con = db_connection();

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// SQL query to select data
$stmt = $con->prepare(
  "
  SELECT 
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
$stmt->execute();
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
$con->close();
?>
