<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign-up</title>
</head>

<body>

<?php
$firstname = trim(htmlspecialchars($_POST["firstname"], ENT_SUBSTITUTE, null));
$lastname = trim(htmlspecialchars($_POST["lastname"], ENT_SUBSTITUTE, null));
$mail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$pass = $_POST["pass"];
$confirm = $_POST["confirm"];

$errors = [];

if (!$firstname) {
    $errors[] = "Invalid name";
}

if (!$lastname) {
    $errors[] = "Invalid lastname";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email";
} else {
    // TODO: Controlla se l'utente è già registrato
}

if ($_POST["pass"] != $_POST["confirm"]) {
    $errors[] = "Passwords do not match";
} else {
    $passwd = password_hash(trim($_POST["pass"]), PASSWORD_DEFAULT);
}

if (!$passwd) {
    $errors[] = "Invalid password";
}

if (empty($errors)) {
    echo '<p> You can now go to the <a href="./login.html"> login page </a></p>';

    // mi collego al db
    $con = new mysqli("localhost", "root", "", "todolist");

    $stmt = mysqli_prepare(
        $con,
        "INSERT INTO Users (Firstname, Lastname, Email, Password) VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "ss", $firstname, $lastname, $email, $pass);
    mysqli_exec($con, $stmt);
} else {
    echo $errors[0];
    echo " <a href='./registration.php'>retry </a>";
}
?>

</body>
</html>
