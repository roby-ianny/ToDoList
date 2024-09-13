<div class="modal fade" id="addProjectModal" tabindex="-2" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addTaskModalLabel">Nuovo Progetto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        if (isset($_SESSION['errors'])) {
          echo '<div class="alert alert-warning" role="alert">' . $_SESSION["errors"] . '. Riprova</div>';
          unset($_SESSION["errors"]);
        }
        ?>
        <form id="addProjectForm" action="./php/add_project.php" method="post">
          <div class="mb-3">
            <label for="add-project-name" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="add-project-name" name="add_project_name" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            <button type="submit" class="btn btn-primary">Inserisci Progetto</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
