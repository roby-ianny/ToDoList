<?php 
  
  if ($_SERVER["REQUEST_METHOD"] != "POST") {
      echo "Invalid request";
      exit;
  }

  $errors = [];

  if ($_POST["firstname"]) {
      $firstname = trim(htmlspecialchars($_POST["firstname"], ENT_SUBSTITUTE, null));
  } else {
      $errors[] = "Invalid name";
  }

  if ($_POST["lastname"]) {
    $lastname = trim(htmlspecialchars($_POST["lastname"], ENT_SUBSTITUTE, null));
  } else {
    $errors[] = "Invalid lastname";
  }

  if($_POST["mail"]){
    $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email";
    }
  }

  if($_POST["pass"]){
    $pass = $_POST["pass"];
  } else {
      $errors[] = "Invalid password";
  }

  if($_POST["confirm"]){
    $confirm = $_POST["confirm"];
  } else {
      $errors[] = "Invalid password";
  }

  if ($pass != $confirm) {
      $errors[] = "Passwords do not match";
  } else {
      $passwd = password_hash(trim($_POST["pass"]), PASSWORD_DEFAULT);
  }
    
  if (empty($errors)) {
    // mi collego al db
    try {
      $con = new mysqli("localhost", "root", "", "todolist");
    } catch (\Throwable $th) {
      error_log("Database connection failed: " . $th->getMessage());
      exit;
    }
 
    // controllo se l'utente già esiste
    $stmt = $con->prepare("SELECT * FROM Users WHERE Email = ?");  
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Email già esistente";
        echo $errors[0];
        echo " <a href='../registration.php'>Riprova</a>";
        exit;
    }

    $stmt = $con->prepare(
      "INSERT INTO Users (Firstname, Lastname, Email, Password) VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $mail, $passwd);
    $stmt->execute();
    header("Location: ../dashboard.php");
    } else {
      echo $errors[0];
      sleep(2);
      header("Location: ../registration.php");
    }
?>
