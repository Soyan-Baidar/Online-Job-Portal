<?php
session_start();
include('connection/db.php');

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $passkey = $_POST['passkey'];

 
    $stmt = $conn->prepare("SELECT * FROM admin_login WHERE admin_email=? AND passkey=?");
    $stmt->bind_param("ss", $email, $passkey);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $_SESSION['email'] = $email;
        $stmt->close();
        $conn->close();
        header('location: admin_dashboard.php');
        exit(); // Stop further execution
    } else {
        echo "<script>alert('Please Try Again !!!')</script>";
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
  <title>Admin Login</title>
  <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
<body class="text-center">
  <form class="form-signin" id="admin_login" name="admin_login" method="POST" action="admin_login.php">
    <img class="mb-4" src="img/Designer.png" alt="" width="102" height="102">
    <h1 class="h3 mb-3 font-weight-normal">Admin Login</h1>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="passkey" class="sr-only">Password</label>
    <input type="password" id="passkey" name="passkey" class="form-control" placeholder="Password" required>
    <input class="btn btn-lg btn-primary btn-block" name="submit" id="submit" type="submit" value="Sign in"><br><br>
    <a href="admin_signup.php" class="link-register">Register for an Account</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
  </form>
</body>
</html>

