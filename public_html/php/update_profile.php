
<?php

require_once("./tasksfunctions.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("location: ../error.php");
  exit;
}

$errors = []; // Inizializza l'array degli errori

if ($_POST["firstname"]) {
  $firstname = trim(htmlspecialchars($_POST["firstname"], ENT_SUBSTITUTE, null));
} else {
  $errors[] = "Nome mancante";
}

if ($_POST["lastname"]) {
  $lastname = trim(htmlspecialchars($_POST["lastname"], ENT_SUBSTITUTE, null));
} else {
  $errors[] = "Cognome mancante";
}

if ($_POST["email"]) {
  $mail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Mail mancante o non valida";
  }
} else {
  $errors[] = "Mail mancante";
}

if ($_POST["profileinfo"]) {
  $profileinfo = trim(htmlspecialchars($_POST["profileinfo"], ENT_SUBSTITUTE, null));
} else {
  $profileinfo = null;
}

if (empty($errors)) { // Solo se non ci sono errori

  $con = db_connection();
  $userid = $_SESSION["session_user"];

  // controllo se l'utente già esiste
  $stmt = $con->prepare("SELECT * FROM Users WHERE Email = ? AND id <> ?");
  $stmt->bind_param("si", $mail, $userid);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $result = $result->fetch_assoc();
    $errors[] = "mail già esistente";
    $_SESSION["errors"] = $errors[0];
    $stmt->close();
    $con->close();
    header("location: ../profile.php");
    exit();
  }

  // aggiorno il profilo
  $stmt = $con->prepare("
    UPDATE Users
    SET 
      FirstName = ?, 
      LastName = ?, 
      Email = ?, 
      Info = ?
    WHERE 
      id = ?
  ");

  $stmt->bind_param('ssssi', $firstname, $lastname, $mail, $profileinfo, $userid);

  if (!$stmt->execute()) { // Corretto il controllo della sintassi
    $errors[] = "Errore durante l'aggiornamento del profilo";
  }

  $stmt->close();
  $con->close();
}

if (!empty($errors)) {
  $_SESSION['errors'] = $errors[0]; // Salva gli errori nella sessione
  header("location: ../profile.php");
  exit();
}

header("location: ../profile.php");
exit();
