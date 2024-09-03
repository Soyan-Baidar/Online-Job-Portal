<?php 
include('connection/db.php');
 $email = $_POST['email'];
 $Username = $_POST['Username'];
 $Password = $_POST['Password'];
 $first_name = $_POST['first_name'];
 $last_name = $_POST['last_name'];
 $admin_type = $_POST['admin_type'];

$query = mysqli_query($conn, "INSERT INTO admin_login(admin_email	,passkey,admin_username,first_name,last_name,admin_type) 
                                 VALUES('$email','$Username','$Password','$first_name','$last_name','$admin_type')
                                 ");
if($query){
    echo " <div class = 'alert alert-success'>Data Inserted Successfully.</div>";
}else{
    echo "<div class = 'alert alert-danger'>Error</div>";
}
?>