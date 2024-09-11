  $(document).ready(function () {
    $('#TasksTable').DataTable({
      "ajax": "../php/fetch_data.php", // Il file PHP che restituisce i dati
      "columns": [
        {"data": "TaskName", type: "string"},
        {"data": "TaskCreation", type: "date"},
        {"data": "TaskDue", type: "date"},
        {"data": "TaskRecurrency", type: "num"},
        {
          "data": "TaskDone",
          "render": function (data, type, row) {
              const status = data === 1 ? 'done' : 'not-done';
              const buttonClass = data === 1 ? 'btn-outline-success' : 'btn-outline-danger';
              const buttonText = data === 1 ? 'Fatto' : 'Da Fare';
              if(data===1) console.log("task da fare");

              return '<button class="btn ' + buttonClass + ' task-status" data-id="' + row.id + '" data-status="' + status + '">' + buttonText + '</button>';
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

  // Aggiornamento del task fatto/da fare
$('#TasksTable').on('click','.task-status', function () {
    var taskId = $(this).data('id');
    var status = $(this).data('status');

    $.ajax({
      url: '../php/task_status_update.php',
      type: 'POST',
      data: {
        id: taskId,
        status: status
      },
      success: function (response) {
        console.log(response);
        $('#TasksTable').DataTable().ajax.reload();
      },
      error: function(xhr, status, error){
        console.error(error);
      }
    });
})
