<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>SignUp</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Internal CSS for custom styling -->
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

      body {
        background: linear-gradient(135deg, #2c3e50, #3498db);
        color: #fff;
        font-family: 'Roboto', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
      }

      .form-signin {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 1s ease-in-out;
        max-width: 400px;
        width: 100%;
        text-align: center;
        color: #2c3e50;
      }

      .logo-container {
        background: #3498db;
        padding: 20px;
        border-radius: 15px 15px 0 0;
        margin: -30px -30px 20px -30px;
        animation: slideDown 1s ease-in-out;
      }

      .logo {
        width: 80px;
        height: auto;
        animation: bounce 2s infinite;
      }

      .form-control {
        background: #ecf0f1;
        border: 1px solid #bdc3c7;
        color: #2c3e50;
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s;
      }

      .form-control::placeholder {
        color: #7f8c8d;
      }

      .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
      }

      .btn-primary {
        background: #3498db;
        border: none;
        border-radius: 10px;
        padding: 15px;
        font-size: 18px;
        transition: background 0.3s;
      }

      .btn-primary:hover {
        background: #2980b9;
      }

      a {
        color: #3498db;
      }

      a:hover {
        color: #2980b9;
        text-decoration: none;
      }

      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
          transform: translateY(0);
        }
        40% {
          transform: translateY(-10px);
        }
        60% {
          transform: translateY(-5px);
        }
      }

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>

  <body>
    <form class="form-signin" action="sign_up.php" method="POST" onsubmit="return validateForm()">
      <div class="logo-container">
        <img class="logo" src="admin/img/Designer.png" alt="Logo">
      </div>
      <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required 
             pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}" 
             title="Password must contain at least 8 characters, including UPPER/lowercase, numbers and special characters">
      <label for="first_name" class="sr-only">First Name</label>
      <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required 
             pattern="[A-Za-z]+" title="First name should contain only alphabets">
      <label for="last_name" class="sr-only">Last Name</label>
      <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required 
             pattern="[A-Za-z]+" title="Last name should contain only alphabets">
      <label for="contact_number" class="sr-only">Contact Number</label>
      <input type="text" id="contact_number" name="contact_number" class="form-control" placeholder="Contact Number" required 
             pattern="\d{10}" title="Please enter exactly 10 digits">
      <label for="dob" class="sr-only">Date of Birth</label>
      <input type="date" id="dob" name="dob" class="form-control" placeholder="Date of Birth" required>
      <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Sign Up"> 
      <a href="job-post.php">Registered Account</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2024 | jobBloom</p>
    </form>

    <script>
      function validateForm() {
        const contactNumber = document.getElementById('contact_number').value;
        if (contactNumber.length !== 10) {
          alert('Contact number must be exactly 10 digits.');
          return false;
        }
        return true;
      }
    </script>
  </body>
</html>
<?php
include('connection/db.php');

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $dob = $_POST['dob'];
  $contact_number = $_POST['contact_number'];

  // Backend validation for contact number
  if (!preg_match('/^\d{10}$/', $contact_number)) {
    echo "<script> alert('Contact number must be exactly 10 digits.')</script>";
    exit;
  }

  // Backend validation for password strength
  if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}$/', $password)) {
    echo "<script> alert('Password must contain at least 8 characters, including UPPER/lowercase, numbers and special characters.')</script>";
    exit;
  }

  // Backend validation for first and last names
  if (!preg_match('/^[A-Za-z]+$/', $first_name)) {
    echo "<script> alert('First name should contain only alphabets.')</script>";
    exit;
  }
  
  if (!preg_match('/^[A-Za-z]+$/', $last_name)) {
    echo "<script> alert('Last name should contain only alphabets.')</script>";
    exit;
  }

  // Check if email already exists
  $check_query = "SELECT * FROM jobsekeer WHERE email = '$email'";
  $result = mysqli_query($conn, $check_query);
  if(mysqli_num_rows($result) > 0) {
    echo "<script> alert('Email already exists!')</script>";
  } else {
    $query = "INSERT INTO jobsekeer (email, password, first_name, last_name, dob, contact_number) VALUES ('$email', '$password', '$first_name', '$last_name', '$dob', '$contact_number')";
    
    if(mysqli_query($conn, $query)){
      // Account registered successfully, display message using JavaScript
      echo "<script>";
      echo "alert('Account registered successfully!');";
      echo "window.location='job-post.php';";
      echo "</script>";
      exit;
    } else {
      echo "<script> alert('Error')</script>";
    }
  }
}
?>
