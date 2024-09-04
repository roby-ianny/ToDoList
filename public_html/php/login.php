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
        $passwd = trim($_POST["pass"]);
    } else {
        $errors[] = "Invalid password";
    }

    $con = new mysqli("localhost", "root", "", "todolist");

    $stmt = $con->prepare("SELECT Password FROM Users WHERE Email = ?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0){
      $db_pwd = $result->fetch_assoc(); 
      if(password_verify($passwd, $db_pwd["Password"])){
        echo "You are now logged id, you can go to your Homepage";
        header("location:  ../dashboard.php");
      } else {
        $errors[] = "Invalid email or password";
        echo $errors[0]; 
      }
   }
?>
