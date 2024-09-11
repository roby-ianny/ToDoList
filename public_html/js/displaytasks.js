  $(document).ready(function () {
    $('#TasksTable').DataTable({
      "ajax": "../php/fetch_data.php", // Il file PHP che restituisce i dati
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
              return  '<a class="btn btn-outline-success" href="../php/task_status_update.php?id=" + data.id +" >Fatto</a>';
            else
              return '<a class="btn btn-outline-danger" href="../php/task_status_update.php?id=" + data.id +">Da Fare</a>';
          }
        },
        {"data": "TaskNotes", type: "string"},
        {"data": "ProjectName", type: "string"},
        {
          "data": null,
          "render": function (data, type, row) {
            //return '<a class="btn btn-primary" href="./edit_task.php?id=' + data.id + '">Modifica</a>';
            return '<a class="btn btn-primary" href="../wip.php">Modifica</a>';
          }
        }
      ]
    });
  });
