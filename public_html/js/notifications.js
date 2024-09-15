// Evito il comportamento di default del form
$(document).ready(function() {
  $('#modalReminderForm').on('submit', function(event) {
    event.preventDefault();
    var reminderDate = $('#reminder-date').val();
    var reminderTime = $('#reminder-time').val();
    var taskName = $('#reminder-name').val();
    console.log('Promemoria impostato per:', reminderDate, 'alle', reminderTime);
    setReminder(reminderDate, reminderTime, taskName);
  });
});

function checkNotificationPermission() {
  if (Notification.permission != 'granted') {
    Notification.requestPermission().then((result) => {
      console.log(result);
    });
  }
}

function displayNotification(body) {
  if (Notification.permission == 'granted') {
    var notification = new Notification("ToDoList", {
      body: body
    });
    notification.displayNotification();
  }
}

function setReminder(date, time, body) {
  $('#setReminderModal').modal('hide');
  checkNotificationPermission();
  var now = new Date();
  var reminderDateTime = new Date(date + ' ' + time);
  var timeUntilReminder = reminderDateTime - now;
  console.log(timeUntilReminder / 1000);
  if (timeUntilReminder <= 0) {
    alert("Per favore, scegli un orario futuro.");
    return;
  }

  setTimeout(() => {
    displayNotification(body);
  }, timeUntilReminder)
}


