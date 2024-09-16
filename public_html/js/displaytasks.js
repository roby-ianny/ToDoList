$(document).ready(function() {
  $('#TasksTable').DataTable({
    "responsive": true,
    "ajax": "./php/fetch_data.php", // Il file PHP che restituisce i dati
    "searching": false,
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
          const buttonText = data === 1 ? '<i class="bi bi-check2-circle"></i> Fatto' : '<i class="bi bi-circle"></i> Da Fare';
          if (data === 1) console.log("task da fare");

          return '<button class="btn ' + buttonClass + ' task-status" data-id="' + row.id + '" data-status="' + status + '">' + buttonText + '</button>';
        }
      },
      { "data": "TaskNotes", type: "string" },
      { "data": "ProjectName", type: "string" },
      {
        "data": null,
        "render": function(data, type, row) {
          return `
          <button type="button" class="btn btn-primary" value="Modifica Task"
          data-bs-toggle="modal" 
          data-bs-target="#editTaskModal" 
          data-id="${row.id}" 
          data-name="${row.TaskName}" 
          data-due="${row.TaskDue}" 
          data-recurrency="${row.TaskRecurrency}" 
          data-status="${row.TaskDone}" 
          data-notes="${row.TaskNotes}">
          <i class="bi bi-pencil-square"></i>
          Modifica
          </button>
          <button type="button" class="btn btn-warning" value="Ricordamelo" data-bs-toggle="modal" data-bs-target="#setReminderModal"
            data-remindername="${row.TaskName}" 
            data-reminderdate="${row.TaskDue}"
          >
          <i class="bi bi-bell"></i>
          Ricordamelo
          </button>
          <button type="button" class="btn btn-danger" value="Elimina Task"
          onclick="deleteTask(${row.id})">
          <i class="bi bi-trash"></i>
          Elimina
          </button>
          `;
        }
      }

    ],
    "language": {
      "emptyTable": "Nessun task presente o nessun task trovato!" // Messaggio quando non ci sono dati
    }
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
    url: './php/task_status_update.php',
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

// Passaggio dei dati al modal dei promemoria
$('#TasksTable').on('click', '.btn-warning[data-bs-target="#setReminderModal"]', function() {
  const taskname = $(this).data('remindername');
  var reminderdate = $(this).data('reminderdate');
  // Se non c'è nessuna data di scadenza allora metto la data di oggi
  if (reminderdate == null) reminderdate = (new Date()).toISOString().split('T')[0];
  var remindertime = new Date();
  remindertime = remindertime.getHours() + ":" + remindertime.getMinutes();

  $('#reminder-name').val(taskname);
  $('#reminder-date').val(reminderdate);
  $('#reminder-time').val(remindertime);
});


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
    url: './php/fetch_userprojects.php',
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
    url: './php/fetch_userprojects.php',
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
// Passaggio progetti al modal per eliminare i tasks
$('#deleteProjectButton').on('click', function() {
  // Prendo la lista dei progetti tramite ajax
  $.ajax({
    url: './php/fetch_userprojects.php',
    type: 'POST',
    success: function(projects) {
      // elimino le opzioni attuali nel form (anche se vuote)
      $('#delete-project-id').empty();

      // Popolo le opzioni 
      projects.forEach(function(project) {
        $('#delete-project-id').append(new Option(project.ProjectName, project.ProjectId));
      });
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
});

// Eliminazione dei tasks
function deleteTask(taskId) {
  $.ajax({
    url: './php/delete_task.php',
    type: 'POST',
    data: {
      id: taskId
    },
    success: function(response) {
      console.log(response);
      $('#TasksTable').DataTable().ajax.reload();
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}

// Ricerca
$('#searchButton').on('click', function() {
  const searchTerm = $('#searchInput').val();

  $.ajax({
    url: './php/search_data.php',
    type: 'GET',
    data: {
      search: searchTerm // Invia il termine di ricerca al server
    },
    success: function(data) {
      // Supponendo che il server restituisca i dati in formato JSON
      console.log(data);
      const dataTable = $('#TasksTable').DataTable();

      dataTable.clear().draw(); // Pulisci i dati esistenti
      if (data.data && (data.data.length > 0) && !((data.data[0].length == 0))) {
        console.log("sono nell'if statement!");
        dataTable.rows.add(data.data).draw();
      }
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
});

// Ricarica tabella
$('#reloadTable').on('click', function() {
  $('#TasksTable').DataTable().ajax.reload();
})
