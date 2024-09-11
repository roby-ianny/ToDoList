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
            return `<button type="button" class="btn btn-primary" 
              data-bs-toggle="modal" 
              data-bs-target="#editTaskModal" 
              data-id="${row.id}" 
              data-name="${row.TaskName}" 
              data-due="${row.TaskDue}" 
              data-recurrency="${row.TaskRecurrency}" 
              data-status="${row.TaskDone}" 
              data-notes="${row.TaskNotes}">
                Modifica
              </button>`;
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

// Passaggio dei dati al modal per la modifica
$('#editTaskModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Il pulsante che ha attivato il modal
    var taskId = button.data('id'); // Estrai l'ID del task
    var taskName = button.data('name'); // Estrai il nome del task
    var taskDue = button.data('due'); // Estrai la data di scadenza
    var taskRecurrency = button.data('recurrency'); // Estrai la ricorrenza
    var taskStatus = button.data('status'); // Estrai lo stato del task
    var taskNotes = button.data('notes'); // Estrai le note del task

    // Aggiorna i campi del modal con i dati estratti
    var modal = $(this);
    modal.find('#task-id').val(taskId);
    modal.find('#task-name').val(taskName);
    modal.find('#task-due').val(taskDue);
    modal.find('#task-recurrency').val(taskRecurrency);
    modal.find('#task-status').val(taskStatus);
    modal.find('#task-notes').val(taskNotes);
});


