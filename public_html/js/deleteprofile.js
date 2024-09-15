$(document).ready(function() {
  $('#deleteProfileButton').on('click', function() {
    console.log("Pulsante cliccato");
    if (confirm("Sei sicuro di voler eliminare il tuo profilo?")) {
      $.ajax({
        url: './php/delete_profile.php',
        type: 'POST',
        success: function(response) {
          console.log(response);
          window.location.replace("./php/logout.php");
        },
        error: function(xhr, status, error) {
          console.error(error);
          window.location.replace("./php/logout.php");
        }
      });
    }
  });
});

