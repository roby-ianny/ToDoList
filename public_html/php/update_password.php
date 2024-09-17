<?php
require_once("./tasksfunctions.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("location: ../error.php");
  exit;
}

$errors = [];

// Controllo i valori in input
if ($_POST["old-password"]){
  $oldpassword = trim($_POST["old-password"]);
} else {
  $errors[] = "Vecchia password mancante";
}

if ($_POST["password"]){
  $password = trim($_POST["password"]);
} else {
  $errors[] = "Nuova password mancante";
}

if ($_POST["confirm"]){
  $confirm = trim($_POST["confirm"]);
} else {
  $errors[] = "Conferma password mancante";
}

if (!check_password($password)) {
  $errors[] = "Nuova password non valida";
}

if (!empty($errors)) {
  $_SESSION["errors"] = $errors[0];
  header("location: ../profile.php");
  exit();
}

$con = db_connection();

// Controllo se la vecchia password è corretta
$userid = $_SESSION["session_user"];
$stmt = $con->prepare("SELECT Password FROM Users WHERE id = ?");
$stmt->bind_param("i", $userid);
if(!($stmt->execute())){
  $errors[] = "Errore di connessione al database";
  $_SESSION["errors"] = $errors[0];
  header("location: ../error.php");
  exit();
}

$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $db_pwd = $result->fetch_assoc();
  if (!password_verify($oldpassword, $db_pwd["Password"])) {
    $errors[] = "Vecchia password non corretta";
    $_SESSION["errors"] = $errors[0];
    $stmt -> close();
    $con -> close();
    header("location: ../profile.php");
    exit();
  } else if ($password != $confirm) {
    $errors[] = "Le password non corrispondono";
    $_SESSION["errors"] = $errors[0];
    $stmt -> close();
    $con -> close();
    header("location: ../profile.php");
    exit();
  } else {
    $passwd = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $stmt = $con->prepare("UPDATE Users SET Password = ? WHERE id = ?");
    $stmt->bind_param("si", $passwd, $userid);
    if(!($stmt->execute())){
      $errors[] = "Errore di connessione al database";
      $_SESSION["errors"] = $errors[0];
      $stmt -> close();
      $con -> close();
      header("location: ../error.php");
      exit();
    }
    $stmt -> close();
    $con -> close();
    header("location: ./logout.php");
    exit();
  }
}
