<?php
require_once("./tasksfunctions.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("location: ../error.php");
  exit;
}

$errors = [];

if ($_POST["firstname"]) {
  $firstname = trim(htmlspecialchars($_POST["firstname"], ENT_SUBSTITUTE, null));
} else {
  $errors[] = "Nome mancante";
}

if ($_POST["lastname"]) {
  $lastname = trim(htmlspecialchars($_POST["lastname"], ENT_SUBSTITUTE, null));
} else {
  $errors[] = "Cognome Mancante";
}

if ($_POST["mail"]) {
  $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
  if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Mail mancante o non valida";
  }
}

if ($_POST["pass"] && $_POST["confirm"]) {
  $pass = $_POST["pass"];
  $confirm = $_POST["confirm"];
  if ($pass != $confirm) {
    $errors[] = "Le password non corrispondono";
  } else {
    $passwd = password_hash(trim($_POST["pass"]), PASSWORD_DEFAULT);
  }
} else {
  $errors[] = "Password non valida e/o mancante";
}

if (!empty($errors)) {
  $_SESSION["errors"] = $errors[0];
  header("location: ../registration.php");
  exit();
}
// mi collego al db
$con = db_connection();

// controllo se l'utente già esiste
$stmt = $con->prepare("SELECT * FROM Users WHERE Email = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $errors[] = "Utente già registrato";
  $_SESSION["errors"] = $errors[0];
  header("location: ../registration.php");
  exit();
}

// inserisco l'utente nel db
$stmt = $con->prepare(
  "INSERT INTO Users (Firstname, Lastname, Email, Password) VALUES (?, ?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $mail, $passwd);
$stmt->execute();

//Prendo l'id
$userid = $con->insert_id;
if (!($userid)) {
  header("location: ../error.php");
  exit();
}

//aggiungere la creazione di un progetto di default
$stmt = $con->prepare(
  "INSERT INTO Projects (Name, Creator) VALUES (?, ?)"
);
$defaultprojectname = 'Generale';
$stmt->bind_param("si", $defaultprojectname, $userid);
$stmt->execute();

//TODO: aggiungere la creazione di un task di default
$projectid = $con->insert_id;
if (!($projectid)) {
  header("location: ../error.php");
  exit();
}

$stmt = $con->prepare(
  "INSERT INTO Tasks (Name, Creation, Project) VALUES (?, NOW(), ?)"
);
$defaulttaskname = 'Benvenuto';
$stmt->bind_param("si", $defaulttaskname, $projectid);
$stmt->execute();


// setto le variabili di sessione per sapere se l'utente è loggato
session_regenerate_id();
$_SESSION["session_id"] = session_id();
$_SESSION["session_user"] = $userid;
$con->close();
$stmt->close();
header("location:  ../dashboard.php");
exit();
