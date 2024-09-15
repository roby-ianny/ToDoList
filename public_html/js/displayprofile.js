$(document).ready(function() {
  $.ajax({
    url: './php/show_profile.php',
    type: 'POST',
    success: function(response) {
      console.log(response);
      const { firstname, lastname, email, info } = response.data ;
      $('#firstname').val(firstname);
      $('#lastname').val(lastname);
      $('#email').val(email);
      $('#profileinfo').val(info);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
})
