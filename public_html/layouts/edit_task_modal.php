<div class="modal fade" id="editTaskModal" tabindex="-2" aria-labelledby="editTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editTaskModalLabel">Modifica Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editTaskForm" action="./php/edit_task.php" method="post">
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
            <label for="task-recurrency" class="col-form-label">Ricorrenza (in giorni):</label>
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
            <label for="task-project" class="col-form-label">Progetto:</label>
            <select class="form-control" id="task-project" name="task_project">
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
