$(document).ready(function() {
  $('#TasksTable').DataTable({
    "ajax": "../php/fetch_data.php", // Il file PHP che restituisce i dati
    "columns": [
      { "data": "TaskName", type: "string" },
      {
        "data": "TaskCreation",
        "render": function(data) {
          return formatDate(data);
        },
        type: "date"
      },
      {
        "data": "TaskDue",
        "render": function(data) {
          return formatDate(data);
        },
        type: "date"
      },
      { "data": "TaskRecurrency", type: "num" },
      {
        "data": "TaskDone",
        "render": function(data, type, row) {
          const status = data === 1 ? 'done' : 'not-done';
          const buttonClass = data === 1 ? 'btn-outline-success' : 'btn-outline-danger';
          const buttonText = data === 1 ? 'Fatto' : 'Da Fare';
          if (data === 1) console.log("task da fare");

          return '<button class="btn ' + buttonClass + ' task-status" data-id="' + row.id + '" data-status="' + status + '">' + buttonText + '</button>';
        }
      },
      { "data": "TaskNotes", type: "string" },
      { "data": "ProjectName", type: "string" },
      {
        "data": null,
        "render": function(data, type, row) {
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

  // formattazione della data
  function formatDate(dateString) {
    if (dateString === null) return null;
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');        // Giorno e eventuale zero 
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Mese e eventuale zero 
    const year = date.getFullYear(); // Ottieni l'anno
    return `${day}/${month}/${year}`;
  }
});




// Aggiornamento del task fatto/da fare
$('#TasksTable').on('click', '.task-status', function() {
  var taskId = $(this).data('id');
  var status = $(this).data('status');

  $.ajax({
    url: '../php/task_status_update.php',
    type: 'POST',
    data: {
      id: taskId,
      status: status
    },
    success: function(response) {
      console.log(response);
      $('#TasksTable').DataTable().ajax.reload();
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
})

// Passaggio dei dati al modal per modificare i tasks
$('#TasksTable').on('click', '.btn-primary[data-bs-target="#editTaskModal"]', function() {
  // Estrai i dati dal pulsante
  const taskId = $(this).data('id');
  const taskName = $(this).data('name');
  const taskDue = $(this).data('due');
  const taskRecurrency = $(this).data('recurrency');
  const taskStatus = $(this).data('status');
  const taskNotes = $(this).data('notes');

  // Popola i campi del modal con i dati estratti
  $('#task-id').val(taskId);
  $('#task-name').val(taskName);
  $('#task-due').val(taskDue);
  $('#task-recurrency').val(taskRecurrency);
  $('#task-status').val(taskStatus);
  $('#task-notes').val(taskNotes);

  // Prendo la lista dei progetti tramite ajax
  $.ajax({
    url: '../php/fetch_userprojects.php',
    type: 'POST',
    success: function(projects) {
      // elimino le opzioni attuali nel form (anche se vuote)
      $('#task-project').empty();

      // Popolo le opzioni 
      projects.forEach(function(project) {
        $('#task-project').append(new
          Option(project.ProjectName, project.ProjectId));
      });
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
});

//Passaggio dei progetti al modal per aggiungere i tasks
$('#addTaskButton').on('click', function() {
  // Prendo la lista dei progetti tramite ajax
  $.ajax({
    url: '../php/fetch_userprojects.php',
    type: 'POST',
    success: function(projects) {
      // elimino le opzioni attuali nel form (anche se vuote)
      $('#add-task-project').empty();

      // Popolo le opzioni 
      projects.forEach(function(project) {
        $('#add-task-project').append(new Option(project.ProjectName, project.ProjectId));
      });
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
});

