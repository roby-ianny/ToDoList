<?php 
function db_connection(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "todolist";

  try {
    $con = new mysqli($servername, $username, $password, $dbname);

    if ($con->connect_error) {
      throw new Exception("Errore di connessione al Database: " . $con->connect_error);
    }

    return $con;
  } catch (Throwable $e) {
    $con -> close();
    header("Location: error.php");
    return false;
  }
}

function insert_task(){
}
