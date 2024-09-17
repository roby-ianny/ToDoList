<!-- navbar e head-->
<?php include './layouts/navbar.php'; ?>
<!--page content -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-xl-8">
      <h1>Registrati</h1>
      <?php
      if (isset($_SESSION['errors'])) {
        echo '<div class="alert alert-warning" role="alert">' . $_SESSION["errors"] . '. Riprova</div>';
        unset($_SESSION['errors']);
      }
      ?>
      <form action="./php/registration.php" method="post">
        <div class="mb-3">
          <label for="firstname" class="form-label">Nome</label>
          <input type="text" class="form-control" name="firstname">
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Cognome</label>
          <input type="text" class="form-control" name="lastname">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password</label>
          <input type="password" class="form-control" name="pass">
        </div>
        <div class="mb-3">
          <label for="confirm" class="form-label">Conferma Password</label>
          <input type="password" class="form-control" name="confirm">
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary" name="submit" value="Registrati">Registrati</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- footer -->
<?php include './layouts/footer.php'; ?>
