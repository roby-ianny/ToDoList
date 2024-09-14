<div class="modal fade" id="updatePasswordModal" tabindex="-2" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editTaskModalLabel">Modifica Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="./php/update_password.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="old-password" class="col-form-label">Vecchia Password:</label>
            <input type="password" class="form-control" id="old-password" name="old-password" required>
          </div>
          <div class="mb-3">
            <label for="old-password" class="col-form-label">Nuova Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="old-password" class="col-form-label">Nuova Password (conferma):</label>
            <input type="password" class="form-control" id="confirm" name="confirm" required>
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
