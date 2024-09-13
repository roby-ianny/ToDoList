
<div class="modal fade" id="deleteProjectModal" tabindex="-2" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addTaskModalLabel">Elimina Progetto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        if (isset($_SESSION['errors'])) {
          echo '<div class="alert alert-warning" role="alert">' . $_SESSION["errors"] . '. Riprova</div>';
          unset($_SESSION["errors"]);
        }
        ?>
        <form id="deleteProjectForm" action="./php/delete_project.php" method="post">
          <div class="mb-3">
            <label for="delete-project-id" class="col-form-label">Progetto:</label>
            <select class="form-control" id="delete-project-id" name="delete_project_id">
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            <button type="submit" class="btn btn-danger">Elimina Progetto</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
