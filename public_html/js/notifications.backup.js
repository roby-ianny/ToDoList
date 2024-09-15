// Funzione per inviare la notifica
function sendNotification(message) {
  if (Notification.permission === "granted") {
    new Notification(message);
  }
}

// Gestire l'invio del modulo con jQuery
$('#modalReminderForm').on('submit', function(event) {
  console.log("pulsante cliccato");
  event.preventDefault(); // Impedire l'invio del modulo

  const reminderTime = new Date($('#reminder-time').val());
  console.log(reminderTime);
  const now = new Date();

  // Richiedere il permesso per le notifiche solo quando l'utente clicca
  if (Notification.permission !== "granted") {
    Notification.requestPermission().then(permission => {
      if (permission === "granted") {
        alert("Permesso per le notifiche concesso!");
        setReminder(reminderTime, now);
      } else {
        alert("Permesso per le notifiche negato.");
      }
    });
  } else {
    setReminder(reminderTime, now);
  }
});

// Funzione per impostare il promemoria
function setReminder(reminderTime, now) {
  const timeUntilReminder = reminderTime - now;

  if (timeUntilReminder > 0) {
    // Impostare la notifica
    setTimeout(() => {
      sendNotification("È ora del tuo promemoria!");
    }, timeUntilReminder);
    alert("Promemoria impostato!");
  } else {
    alert("Per favore, scegli un orario futuro.");
  }
}
