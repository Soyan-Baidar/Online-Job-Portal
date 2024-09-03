<?php
session_start();
error_reporting(0);
include('connection/db.php');
$header = mysqli_query($conn, "SELECT * FROM profiles WHERE user_email='{$_SESSION['email']}'");
while($row = mysqli_fetch_array($header)){
  $image = $row['image']; // Fetching the correct image field
  $name = $row['name'];
  $dob = $row['dob'];
  $number = $row['number'];
  $email = $row['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Job Bloom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">JobBloom</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php if($page=='home'){echo 'active';} ?>"><a href="index.php" class="nav-link">Home</a></li>
<li class="nav-item <?php if($page=='about'){echo 'active';} ?>"><a href="about.php" class="nav-link">About</a></li>
<li class="nav-item <?php if($page=='contact'){echo 'active';} ?>"><a href="contact.php" class="nav-link">Contact</a></li>
<?php
        if(isset($_SESSION['email'])) { ?>
            <li class="nav-item cta mr-md-2">
            <a href="admin/admin_login.php" class="nav-link">
    <?php 
    if (empty($name)) {
        echo isset($_SESSION['email']) ? $_SESSION['email'] : '';
    } else {
        echo $name;
    }
    ?>
</a>
            </li>
            
            <li class="nav-item dropdown">
    <div class="dropdown">
    <img src="<?php echo !empty($image) ? 'profile_image/' . $image : 'profile_image/elseimage.jpeg'; ?>" class="img rounded-circle dropdown-toggle ml-2" id="profileDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" alt="Profile Picture" width="60" height="60">
        <ul class="dropdown-menu dropdown-menu-right animate__animated animate__fadeIn" aria-labelledby="profileDropdown" style="background-color: #f8f9fa; border: 1px solid #ced4da;">
            <li class="dropdown-item" style="background-color: #fff;"><a href="my_profile.php" style="color: #212529;">My Profile</a></li>
            <li class="dropdown-item" style="background-color: #fff;"><a href="change_pass.php" style="color: #212529;">Change Password</a></li>

            <div class="dropdown-divider" style="background-color: #ced4da;"></div>
            <li class="dropdown-item" style="background-color: #fff;"><a href="logout.php" style="color: #dc3545;">Logout</a></li>
        </ul>
    </div>
</li>



                        <!-- Add more dropdown items as needed -->
                    </ul>
                </div>
            </li>
        <?php } else { ?>
            <li class="nav-item cta mr-md-2">
                <a href="job-post.php" class="nav-link">Connect Zone</a>
            </li>
        <?php } ?>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
