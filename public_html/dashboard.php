<!-- navbar and header -->
<?php include "./layouts/navbar.php"; ?>
<!--page content -->
<?php include "./php/checksession.php" ?>
<div class="container mt-5">
  <div class="table-responsive-sm">
    <table id="TasksTable" class="table table-hover table-bordered align-middle">
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
    <a class="btn btn-primary" href="./wip.php">Modifica</a>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#TasksTable').DataTable({
      "ajax": "./php/fetch_data.php", // Il file PHP che restituisce i dati
      "columns": [
        {"data": "TaskName", type: "string"},
        {"data": "TaskCreation", type: "date"},
        {"data": "TaskDue", type: "date"},
        {"data": "TaskRecurrency", type: "num"},
        //{"data": "TaskDone", type: "num"},
        {
          "data": "TaskDone",
          "render": function (data, type, row) {
            if (data === 1)
              return '<input type="checkbox" checked>';
            else
              return '<input type="checkbox" >';
          }
        },
        {"data": "TaskNotes", type: "string"},
        {"data": "ProjectName", type: "string"},
        {
          "data": null,
          "render": function (data, type, row) {
            //return '<a class="btn btn-primary" href="./edit_task.php?id=' + data.id + '">Modifica</a>';
            return '<a class="btn btn-primary" href="./wip.php">Modifica</a>';
          }
        }
      ]
    });
  });
</script>
<!-- footer -->
<?php include "./layouts/footer.php"; ?>
