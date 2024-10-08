<!-- navbar and header -->
<?php require_once "./layouts/navbar.php"; ?>
<!--page content -->
<?php require_once "./php/checksession.php" ?>
<!-- Tabella dei tasks -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="input-group mb-3">
        <input type="search" id="searchInput" class="form-control" aria-label="Search" placeholder="Task, Progetto, Note ..."/>
      <button type="button" class="btn btn-primary" id="searchButton" data-mdb-ripple-init>
        <i class="bi bi-search"></i> Cerca
      </button>
      <button type="button" class="btn btn-secondary" id="reloadTable"><i class="bi bi-arrow-clockwise"></i>Ripristina</button>
    </div>
  </div>
  <div class="table-responsive">
    <table id="TasksTable" class="table table-borderless table-hover align-middle" style="text-align: center ;">
      <thead>
        <tr class="table-dark">
          <th>Nome</th>
          <th>Creazione</th>
          <th>Scadenza</th>
          <th>Ricorrenza (in giorni)</th>
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
    <button id="addTaskButton" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">Nuovo Task</button>
    <button id="addProjectButton" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">Nuovo Progetto</button>
    <button id="deleteProjectButton" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProjectModal">Cancella Progetto</button>
  </div>
</div>

<!-- Script per mostrare i tasks nella tabella-->
<script src="./js/displaytasks.js"></script>

<!-- Script per la gestione delle notifiche -->
<script src="./js/notifications.js"></script>

<!-- Modal per modificare il task -->
<?php include_once "./layouts/edit_task_modal.php"; ?>

<!-- Modal per aggiungere un tasks -->
<?php include_once "./layouts/add_task_modal.php"; ?>

<!-- Modal per aggiungere un progetto -->
<?php include_once "./layouts/add_project_modal.php"; ?>

<!-- Modal per eliminare un progetto -->
<?php include_once "./layouts/delete_project_modal.php"; ?>

<!-- Modal per impostare i promemoria -->
<?php include_once "./layouts/reminder_modal.php"; ?>

<!-- footer -->
<?php include "./layouts/footer.php"; ?>
