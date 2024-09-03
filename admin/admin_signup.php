<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .text-muted {
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Sign Up</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="admin_email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" name="passkey" id="Password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" name="admin_username" id="Username" class="form-control" placeholder="Enter your username" required>
            </div>
           
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter your first name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter your last name" required>
            </div>
            <div class="form-group">
                <label for="admin_type">Admin Type</label>
                <select name="admin_type" class="form-control" id="admin_type" required>
                    <option value="2">Customer Admin</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Sign Up">
            </div>
        </form>
        <p class="text-muted text-center">© 2024 Job Bloom</p>
    </div>
</body>
</html>
<?php
include('connection/db.php');

if(isset($_POST['submit'])){
    $admin_email = trim($_POST['admin_email']);
    $passkey = trim($_POST['passkey']);
    $admin_username = trim($_POST['admin_username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $admin_type = $_POST['admin_type'];

    // Validate input fields
    if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit;
    }
    if (strlen($passkey) < 10 || !preg_match('/[A-Z]/', $passkey) || !preg_match('/[a-z]/', $passkey) || !preg_match('/[0-9]/', $passkey)) {
        echo "<script>alert('Password must be at least 10 characters long, contain at least one uppercase letter, one lowercase letter, and one number');</script>";
        exit;
    }
    if (empty($admin_username) || empty($first_name) || empty($last_name)) {
        echo "<script>alert('Please fill in all required fields');</script>";
        exit;
    }
    
    // Check if email already exists
    $check_query = "SELECT * FROM admin_login WHERE admin_email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if(mysqli_num_rows($result) > 0) {
        echo "<script> alert('Email already exists!')</script>";
    } else {
        $query = "INSERT INTO admin_login (admin_email, passkey, admin_username, first_name, last_name, admin_type) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $admin_email, $passkey, $admin_username, $first_name, $last_name, $admin_type);
        
        if($stmt->execute()){
            // Account registered successfully, display message using JavaScript
            echo "<script>";
            echo "alert('Account registered successfully!');";
            echo "window.location='admin_login.php';";
            echo "</script>";
            exit;
        } else {
            echo "<script> alert('Error')</script>";
        }
        $stmt->close();
    }
}
?>
