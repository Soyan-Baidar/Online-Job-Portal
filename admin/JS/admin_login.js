document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('admin_login');
  
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission
  
      // Validate email and password
      var email = document.getElementById('email').value.trim();
      var passkey = document.getElementById('pass').value.trim();
  
      if (email === '') {
        alert('Please enter your email.');
        return;
      }
  
      if (passkey === '') {
        alert('Please enter your password.');
        return;
      }
  
      // If validation passes, submit the form
      form.submit();
    });
  });
  