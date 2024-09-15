<div class="modal fade" id="setReminderModal" tabindex="-2" aria-labelledby="setReminderModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addTaskModalLabel">Imposta Promemoria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="modalReminderForm">
          <input type="hidden" id="reminder-name" name="reminder-name">
          <div class="mb-3">
            <label for="reminder-date" class="col-form-label">Giorno</label>
            <input type="date" class="form-control" id="reminder-date" name="reminder-date">
          </div>
          <div class="mb-3">
            <label for="reminder-time" class="col-form-label">Ora:</label>
            <input type="time" class="form-control" id="reminder-time" name="reminder-time">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            <input type="submit" class="btn btn-primary" value="Imposta Promemoria">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
