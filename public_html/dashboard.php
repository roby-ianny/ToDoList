<!-- navbar and header -->
<?php include "./layouts/navbar.php"; ?>
<!--page content -->
<?php include "./php/checksession.php" ?>
<div class="container mt-5">
  <div class="table-responsive-sm">
    <table id="TasksTable" class="table table-hover table-bordered align-middle" style="text-align: center ;">
      <thead>
        <tr class="table-primary">
          <th>Nome</th>
          <th>Creazione</th>
          <th>Scadenza</th>
          <th>Ricorrenza</th>
          <th>Stato</th>
          <th>Note</th>
          <th>Progetto</th>
          <th>Modifica</th>
        </tr>
      </thead>
      <tbody>
        <!-- I dati verranno caricati qui tramite AJAX -->
      </tbody>
    </table>
    <!-- <a class="btn btn-primary" href="./add_task.php">Aggiungi Task</a> -->
    <a class="btn btn-primary" href="./wip.php">Nuovo Task</a>
  </div>
</div>
<script src="./js/displaytasks.js"></script>
<!-- footer -->
<?php include "./layouts/footer.php"; ?>
