<!doctype html>
<html lang="it">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ToDoList</title>
  <link href="./css/bootstrap.css" rel="stylesheet" />
  <link href="./css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- Including bootsrap javascript -->
  <script src="./js/bootstrap.bundle.js" crossorigin="anonymous"></script>
  <!-- navbar -->
  <?php include "./layouts/navbar.php"; ?>
  <!--page content -->
  <div class="container">
    <div class="row justify-content-center">
        <h1>Login</h1>
        <?php 
          if(isset($_SESSION['errors'])) {
            echo '<div class="alert alert-warning" role="alert">'. $_SESSION["errors"] .'. Riprova</div>';
          }
        ?>
      <form action="./php/login.php" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="mail">
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password</label>
          <input type="password" class="form-control" name="pass">
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-primary" name="submit" value="Login">
        </div>
      </form>
    </div>
  </div>
  <!-- footer -->
  <?php include "./layouts/footer.php"; ?>
</body>

</html>
