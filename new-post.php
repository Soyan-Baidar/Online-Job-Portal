
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="new-post.php" method="POST">
    <img class="mb-4 logo" src="admin/img/Designer.png" alt="Logo"> <!-- Add 'logo' class to the image -->
      <h1 class="h3 mb-3 font-weight-normal"> sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <br>
      <input name="submit" class="btn btn-lg btn-primary btn-block" type="submit" value="Sign In">
      <p class="mt-5 mb-3 text-muted">&copy; 2024 | jobBloom</p>
    </form>
  </body>
</html>
<?php
session_start();
include('connection/db.php');

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitize input
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Sanitize input

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin_login WHERE admin_email=? AND passkey=? AND admin_type='1' OR admin_type='2'");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // Successful login
        $_SESSION['email'] = $email; // Consider using user IDs instead of email
        header('location: admin/admin_dashboard.php');
        exit();
    } else {
        // Failed login attempt
        echo "<script>alert('Invalid email or password. Please try again.')</script>";
    }
    $stmt->close();
}
?>
