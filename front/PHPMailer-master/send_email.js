$(document).ready(function () {
  $('#emailForm').on('submit', function (e) {
      e.preventDefault(); 

      let formData = new FormData(this);

     
      alert('Message is being sent... Please wait for 10 seconds.');

      $.ajax({
          url: 'PHPMailer-master/send_email.php', 
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
              
              alert(response);
          },
          error: function (xhr, status, error) {
            
              alert('An error occurred: ' + error);
          }
      });
  });
});
