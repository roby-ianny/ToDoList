<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
</head>

<body>
  <?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Invalid request";
    exit;
  }

  if (isset($_SESSION['session_id'])) {
    header('Location: ../dashboard.php');
    exit;
  }

  $errors = [];

  if ($_POST["mail"]) {
    $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email";
    }
  }

  if ($_POST["pass"]) {
    $passwd = trim($_POST["pass"]);
  } else {
    $errors[] = "Invalid password";
  }

  $con = new mysqli("localhost", "root", "", "todolist");

  $stmt = $con->prepare("SELECT Password FROM Users WHERE Email = ?");
  $stmt->bind_param("s", $mail);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $db_pwd = $result->fetch_assoc();
    if (password_verify($passwd, $db_pwd["Password"])) {
      session_regenerate_id();
      $_SESSION["session_id"] = session_id();
      $_SESSION["session_user"] = $mail;
      header("location:  ../dashboard.php");
    } else {
      $errors[] = "Email o password non valida";
      echo $errors[0];
    }
  } else {
    $errors[] = "Email o password non valida";
    echo $errors[0];
  }
    ?>

</body>

</html>
