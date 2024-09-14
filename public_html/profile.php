<!-- navbar -->
<?php include "./layouts/navbar.php"; ?>

<!-- script per riempire la pagina con le informazioni del profilo -->
<script src="./js/displayprofile.js"></script>
<!--page content -->
<div class="card m-3">
  <div class="card-body">
    <h5 class="card-title">Il mio pofilo</h5>
    <form class="row g-3">
      <div class="col-md-4">
        <label for="firstname" class="form-label">Nome</label>
        <input type="text" class="form-control" id="firstname">
      </div>
      <div class="col-md-4">
        <label for="lastname" class="form-label">Cognome</label>
        <input type="text" class="form-control" id="lastname">
      </div>
      <div class="col-md-4">
        <label for="email" class="form-label">Mail</label>
        <input type="text" class="form-control" id="email">
      </div>
      <div class="col-12">
        <label for="profileinfo" class="form-label">Su di te</label>
        <input type="text" class="form-control" id="profileinfo" placeholder="Raccontaci qualcosa...">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Modifica Profilo</button>
        <button class="btn btn-warning">Modifica Password</button>
        <button class="btn btn-danger">Elimina Profilo</button>
      </div>
    </form>

  </div>
</div>
<!-- footer -->
<?php include "./layouts/footer.php"; ?>
