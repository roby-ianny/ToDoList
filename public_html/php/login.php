<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign-up</title>
</head>

<body>

    <?php

    if($_SERVER["REQUEST_METHOD"] != "POST") {
        echo "Invalid request";
        exit;
    }

    $errors = [];

    if($_POST["mail"]){
      $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
    
      if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email";
      }
    }

    if($_POST["pass"]){
        $passwd = password_hash(trim($_POST["pass"]), PASSWORD_DEFAULT);
    } else {
        $errors[] = "Invalid password";
    }

    $con = new mysqli("localhost", "root", "", "todolist");

    $stmt = $con->prepare("SELECT * FROM Users WHERE Email = ?");

    mysqli_stmt_bind_param($stmt, "s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo '<p>Accesso effettuato!</a></p>';
    } else {
        $errors[] = "Email o password non valida";
        echo $errors[0];
        echo " <a href='../login.php'>Riprova</a>";
        exit;
    }

    ?>

</body>
</html>
