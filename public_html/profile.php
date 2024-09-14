<!-- navbar -->
<?php include "./layouts/navbar.php"; ?>
<?php include_once "./php/checksession.php" ?>
<!-- script per riempire la pagina con le informazioni del profilo -->
<script src="./js/displayprofile.js"></script>

<!-- script per l'eliminazione del profilo -->
<script src="./js/deleteprofile.js"></script>
<!--page content -->
<div class="card m-3">
  <div class="card-body">
    <h5 class="card-title">Il mio profilo</h5>
    <?php
    if (isset($_SESSION['errors'])) {
      echo '<div class="alert alert-warning" role="alert">' . $_SESSION["errors"] . '. Riprova</div>';
      unset($_SESSION['errors']);
    }
    ?>
    <form class="row g-3" action="./php/update_profile.php" method="post">
      <div class="col-md-4">
        <label for="firstname" class="form-label">Nome</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
      </div>
      <div class="col-md-4">
        <label for="lastname" class="form-label">Cognome</label>
        <input type="text" class="form-control" id="lastname" name="lastname">
      </div>
      <div class="col-md-4">
        <label for="email" class="form-label">Mail</label>
        <input type="text" class="form-control" id="email" name="mail">
      </div>
      <div class="col-12">
        <label for="profileinfo" class="form-label">Su di te</label>
        <input type="text" class="form-control" id="profileinfo" name="profileinfo" placeholder="Raccontaci qualcosa...">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Modifica Profilo</button>
      </div>
    </form>
    <button class="btn btn-warning" data-bs-target="#updatePasswordModal" data-bs-toggle="modal">Modifica Password</button>
    <button class="btn btn-danger" id="deleteProfileButton">Elimina Profilo</button>
  </div>
</div>
<!-- Modal per aggiornare la password -->
<?php include "./layouts/update_password_modal.php"; ?>
<!-- footer -->
<?php include_once "./layouts/footer.php"; ?>
