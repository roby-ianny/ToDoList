<!-- navbar and header -->
<?php require_once "./layouts/navbar.php"; ?>
<!--page content -->
<?php require_once "./php/checksession.php" ?>
<!-- Tabella dei tasks -->
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

<!-- Script per mostrare i tasks nella tabella-->
<script src="./js/displaytasks.js"></script>

<!-- Modal per modificare il task -->
<div class="modal fade" id="editTaskModal" tabindex="-2" aria-labelledby="editTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editTaskModalLabel">Modifica Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editTaskForm" action="./wip.php" method="post">
          <input type="hidden" id="task-id" name="task_id"> <!-- Campo nascosto per l'ID del task -->
          <div class="mb-3">
            <label for="task-name" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="task-name" name="task_name" required>
          </div>
          <div class="mb-3">
            <label for="task-due" class="col-form-label">Scadenza:</label>
            <input type="date" class="form-control" id="task-due" name="task_due">
          </div>
          <div class="mb-3">
            <label for="task-recurrency" class="col-form-label">Ricorrenza:</label>
            <input type="number" class="form-control" id="task-recurrency" name="task_recurrency">
          </div>
          <div class="mb-3">
            <label for="task-status" class="col-form-label">Stato:</label>
            <select class="form-control" id="task-status" name="task_status">
              <option value="0">Non completato</option>
              <option value="1">Completato</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="task-notes" class="col-form-label">Note:</label>
            <textarea class="form-control" id="task-notes" name="task_notes"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        <button type="submit" class="btn btn-primary">Salva modifiche</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- footer -->
<?php include "./layouts/footer.php"; ?>
