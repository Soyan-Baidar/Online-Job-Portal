<?php
include('include/header.php');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['email'])) {
    header('Location: job-post.php');
    exit();
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connection/db.php');

$errors = array();

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $file = $_FILES['file']['name'];
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $cover_letter = mysqli_real_escape_string($conn, $_POST['cover_letter']);
    $tmp_name = $_FILES['file']['tmp_name'];
    $id_job = mysqli_real_escape_string($conn, $_GET['id']);
    $job_seeker = mysqli_real_escape_string($conn, $_SESSION['email']);

    // Validate first name
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required";
    }

    // Validate last name
    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required";
    }

    // Validate date of birth
    if (empty($dob)) {
        $errors['dob'] = "Date of birth is required";
    }

    // Validate file upload
    if (empty($file)) {
        $errors['file'] = "File upload is required";
    }

    // Validate mobile number
    if (empty($number)) {
        $errors['number'] = "Mobile number is required";
    } elseif (!preg_match("/^\d{10}$/", $number)) {
        $errors['number'] = "Invalid mobile number";
    }

    // Validate cover letter
    if (empty($cover_letter)) {
        $errors['cover_letter'] = "Cover letter is required";
    } elseif (strlen($cover_letter) < 100) {
        $errors['cover_letter'] = "Cover letter must be at least 100 characters long";
    }

    // Check if there are no errors
    if (empty($errors)) {
        $sql = mysqli_query($conn, "SELECT * FROM job_apply WHERE job_seeker='$job_seeker' AND id_job ='$id_job'");
        if (mysqli_num_rows($sql) > 0) {
            echo "<script>alert('Already Applied !!');</script>";
        } else {
            // Ensure the 'files/' directory exists and is writable
            if (!is_dir('files')) {
                mkdir('files', 0777, true);
            }

            if (move_uploaded_file($tmp_name, 'files/' . $file)) {
                $query = "INSERT INTO job_apply (first_name, last_name, dob, file, id_job, job_seeker, mobile_number, cover_letter) 
                          VALUES ('$first_name', '$last_name', '$dob', '$file', '$id_job', '$job_seeker', '$number', '$cover_letter')";

                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Your Form Submitted Successfully!');</script>";
                } else {
                    echo "<script>alert('Error submitting form. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('Error uploading file. Please try again.');</script>";
            }
        }
    }
}

// Fetch job details
$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM all_jobs WHERE job_id='$id'");
if ($row = mysqli_fetch_assoc($query)) {
    $title = $row['job_title'];
    $description = $row['description'];
    $country = $row['country'];
    $state = $row['state'];
    $city = $row['city'];
    $id_job = $row['job_id'];
} else {
    // Redirect or handle the case where the job is not found
    header('Location: job-single.php');
    exit();
}
?>

<div class="hero-wrap js-fullheight" style="background-image: url('images/apply.jpeg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" data-scrollax-parent="true">
            <div class="col-md-8 ftco-animate text-center text-md-left mb-5" data-scrollax="properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                    <span class="mr-3"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
                </p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Apply Job</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ftco-animate">
                <h2 class="mb-3" style="font-size: 24px; font-weight: bold; color: #333; margin-bottom: 1.5rem;"><?php echo htmlspecialchars($title); ?></h2>
                <h5 style="font-size: 16px; font-weight: bold; color: #666;"><?php echo htmlspecialchars("$country, $state, $city"); ?></h5>
                <p style="font-size: 14px; color: #777;"><?php echo nl2br(htmlspecialchars($description)); ?></p>
                <hr>

                <form action="" method="POST" id="JobBloom" enctype="multipart/form-data" style="border: 1px solid gray; padding: 2%; margin-bottom: 2rem;">
                    <input type="hidden" name="job_seeker" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" id="job_seeker">
                    <input type="hidden" name="id_job" value="<?php echo htmlspecialchars($id); ?>" id="id_job">

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="first_name" class="fw-bold">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" required>
                            <?php if(isset($errors['first_name'])) echo "<p class='text-danger'>{$errors['first_name']}</p>"; ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="last_name" class="fw-bold">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" required>
                            <?php if(isset($errors['last_name'])) echo "<p class='text-danger'>{$errors['last_name']}</p>"; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="dob" class="fw-bold">Date Of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" required>
                            <?php if(isset($errors['dob'])) echo "<p class='text-danger'>{$errors['dob']}</p>"; ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="file" class="fw-bold">Attach Files (CV/Resume)</label>
                            <input type="file" name="file" id="file" class="form-control" required>
                            <?php if(isset($errors['file'])) echo "<p class='text-danger'>{$errors['file']}</p>"; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="number" class="fw-bold">Contact Information</label>
                            <input type="tel" name="number" id="number" class="form-control" placeholder="Mobile Number" required>
                            <?php if(isset($errors['number'])) echo "<p class='text-danger'>{$errors['number']}</p>"; ?>
                        </div>
                        <div class="col-sm-6">
                            <label class="fw-bold">Email</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="cover_letter" class="fw-bold">Cover Letter</label>
                            <textarea name="cover_letter" id="cover_letter" class="form-control" rows="5" placeholder="Write your cover letter here..." required></textarea>
                            <?php if(isset($errors['cover_letter'])) echo "<p class='text-danger'>{$errors['cover_letter']}</p>"; ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
</body>
</html>
