<div class="modal fade" id="addTaskModal" tabindex="-2" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addTaskModalLabel">Nuovo Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addTaskForm" action="./php/add_task.php" method="post">
          <div class="mb-3">
            <label for="add-task-name" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="add-task-name" name="add_task_name" required>
          </div>
          <div class="mb-3">
            <label for="add-task-due" class="col-form-label">Scadenza:</label>
            <input type="date" class="form-control" id="add-task-due" name="add_task_due">
          </div>
          <div class="mb-3">
            <label for="add-task-recurrency" class="col-form-label">Ricorrenza:</label>
            <input type="number" class="form-control" id="add-task-recurrency" name="add_task_recurrency"></label>
          </div>
          <div class="mb-3">
            <label for="add-task-status" class="col-form-label">Stato:</label>
            <select class="form-control" id="add-task-status" name="add_task_status">
              <option value="0">Non completato</option>
              <option value="1">Completato</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="add-task-project" class="col-form-label">Progetto:</label>
            <select class="form-control" id="add-task-project" name="add_task_project">
            </select>
          </div>
          <div class="mb-3">
            <label for="add-task-notes" class="col-form-label">Note:</label>
            <textarea class="form-control" id="add-task-notes" name="add_task_notes"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            <button type="submit" class="btn btn-primary">Inserisci Task</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
