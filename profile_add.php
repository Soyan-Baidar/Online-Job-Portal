<?php
session_start();
include('connection/db.php');

if (isset($_POST['submit'])) {
    $image = $_FILES['pro-image']['name'];
    $user_email = $_SESSION['email'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $tmp_name = $_FILES['pro-image']['tmp_name'];
    $error = $_FILES['pro-image']['error'];

    // Directory to upload images
    $upload_dir = 'profile_image/';

    // Check for upload errors
    if ($error === UPLOAD_ERR_OK) {
        if (!empty($image)) {
            // Ensure the directory exists
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($tmp_name, $upload_dir . $image)) {
                // File uploaded successfully
            } else {
                echo "<script>alert('Failed to move uploaded file.')</script>";
            }
        }
    } elseif ($error !== UPLOAD_ERR_NO_FILE) {
        echo "<script>alert('File upload error: " . $error . "')</script>";
    }

    // Check if the profile exists
    $sql = mysqli_query($conn, "SELECT * FROM profiles WHERE user_email='$user_email'");
    if (mysqli_num_rows($sql) > 0) {
        // Update existing profile
        if (!empty($image)) {
            $query = mysqli_query($conn, "UPDATE profiles SET image='$image', name='$name', dob='$dob', number='$number', email='$email' WHERE user_email='$user_email'");
        } else {
            $query = mysqli_query($conn, "UPDATE profiles SET name='$name', dob='$dob', number='$number', email='$email' WHERE user_email='$user_email'");
        }
        if ($query) {
            echo "<script>alert('Profile Updated Successfully')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
        }
    } else {
        // Insert new profile
        $query = mysqli_query($conn, "INSERT INTO profiles (image, name, dob, number, email, user_email) VALUES ('$image', '$name', '$dob', '$number', '$email', '$user_email')");
        if ($query) {
            echo "<script>alert('Profile Added Successfully')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
        }
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profile Update</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style type="text/css">
        a, a:focus, a:hover {
            color: #fff;
        }
        .btn-secondary, .btn-secondary:hover, .btn-secondary:focus {
            color: #333;
            background-color: #fff;
            border: .05rem solid #fff;
        }
        html, body {
            height: 100%;
            background-color: #333;
        }
        body {
            display: flex;
            justify-content: center;
            color: #fff;
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }
        .cover-container {
            max-width: 42em;
        }
        .masthead {
            margin-bottom: 2rem;
        }
        .masthead-brand {
            margin-bottom: 0;
        }
        .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }
        .nav-masthead .nav-link:hover, .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
        }
        .nav-masthead .nav-link + .nav-link {
            margin-left: 1rem;
        }
        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }
        @media (min-width: 48em) {
            .masthead-brand {
                float: left;
            }
            .nav-masthead {
                float: right;
            }
        }
        .cover {
            padding: 0 1.5rem;
        }
        .cover .btn-lg {
            padding: .75rem 1.25rem;
            font-weight: 700;
        }
        .mastfoot {
            color: rgba(255, 255, 255, .5);
        }
    </style>
</head>
<body class="text-center">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <main role="main" class="inner cover">
            <p class="lead">
                <a href="my_profile.php" class="btn btn-lg btn-secondary">Back</a>
            </p>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
</body>
</html>
