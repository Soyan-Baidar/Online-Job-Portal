<?php 
session_start();
include('connection/db.php');

if(!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

if(isset($_POST['submit'])){
    $email = $_SESSION['email']; // Get email from session
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Validate password inputs
    if (empty($old_password) || empty($new_password)) {
        echo "<script>alert('Password fields cannot be empty');</script>";
        exit();
    }

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM jobsekeer WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $old_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // Update password
        $update_stmt = $conn->prepare("UPDATE jobsekeer SET password=? WHERE email=?");
        $update_stmt->bind_param("ss", $new_password, $email);
        $update_stmt->execute();

        if($update_stmt->affected_rows > 0){
            echo "<script>
                    alert('Password successfully changed');
                    window.location.href='index.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Password change failed');</script>";
        }

        $update_stmt->close();
    } else {
        echo "<script>alert('Incorrect old password');
        window.location.href='change_pass.php';
      </script>";
        
    }

    $stmt->close();
    $conn->close();
}
?>
