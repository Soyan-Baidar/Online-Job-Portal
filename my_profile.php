<?php
include('connection/db.php');
include('include/header.php');
include('include/my_profile.php');

// Start session
session_start();

// Initialize error array
$errors = array();

// Fetch user profile data
$query = mysqli_query($conn, "SELECT * FROM profiles WHERE user_email='{$_SESSION['email']}'");
$row = mysqli_fetch_array($query);
$image = $row['image'] ?? '';
$name = $row['name'] ?? '';
$dob = $row['dob'] ?? '';
$number = $row['number'] ?? '';
$email = $row['email'] ?? '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $dob = trim(mysqli_real_escape_string($conn, $_POST['dob']));
    $number = trim(mysqli_real_escape_string($conn, $_POST['number']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $file = $_FILES['pro-image'];

    // Validate name
    if (empty($name)) {
        $errors['name'] = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $errors['name'] = "Name can only contain letters and spaces";
    }

    // Validate date of birth
    if (empty($dob)) {
        $errors['dob'] = "Date of birth is required";
    }

    // Validate mobile number
    if (empty($number)) {
        $errors['number'] = "Mobile number is required";
    } elseif (!preg_match("/^\d{10}$/", $number)) {
        $errors['number'] = "Invalid mobile number. Please enter exactly 10 digits.";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Handle file upload
    if ($file['error'] == UPLOAD_ERR_OK) {
        $target_dir = "profile_image/";
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size (5MB max)
        if ($file["size"] > 5000000) {
            $errors['file'] = "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $errors['file'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Check if $errors is empty to proceed with the upload
        if (empty($errors)) {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $image = basename($file["name"]);
            } else {
                $errors['file'] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update profile if no errors
    if (empty($errors)) {
        $query = "UPDATE profiles SET  image='$image',name='$name', dob='$dob', number='$number', email='$email'  WHERE user_email='{$_SESSION['email']}'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Profile updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating profile. Please try again.');</script>";
        }
    }
}
?>

<div style="margin: 50px auto; padding: 20px; max-width: 600px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <form action="profile_add.php" method="post" id="profile_form" name="profile_form" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <div style="flex: 0 0 auto;">
                <img src="profile_image/<?php echo !empty($image) ? $image : 'elseimage.jpeg'; ?>" style="border-radius: 50%; width: 120px; height: 120px; cursor: pointer;" alt="Profile Picture">
            </div>
            <div style="flex: 1; margin-left: 20px;">
                <label for="pro-image" style="cursor: pointer;">Choose Profile Image:</label>
                <input type="file" name="pro-image" id="pro-image" style="display: none;">
                <button type="button" onclick="document.getElementById('pro-image').click();" style="padding: 8px 15px; border: 1px solid #007bff; border-radius: 5px; background-color: #007bff; color: #fff; cursor: pointer;">Browse</button>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="name">Your Name:</label>
            <input type="text" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%; box-sizing: border-box;" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter Full Name" required>
            <?php if(isset($errors['name'])) echo "<p class='text-danger'>{$errors['name']}</p>"; ?>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="dob">Date of Birth:</label>
            <input type="date" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%; box-sizing: border-box;" name="dob" id="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
            <?php if(isset($errors['dob'])) echo "<p class='text-danger'>{$errors['dob']}</p>"; ?>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="number">Mobile Number:</label>
            <input type="tel" pattern="\d{10}" title="Please enter exactly 10 digits" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%; box-sizing: border-box;" name="number" id="number" value="<?php echo htmlspecialchars($number); ?>" placeholder="Enter 10-digit Mobile Number" required>
            <?php if(isset($errors['number'])) echo "<p class='text-danger'>{$errors['number']}</p>"; ?>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="email">Email:</label>
            <input type="email" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%; box-sizing: border-box;" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <?php if(isset($errors['email'])) echo "<p class='text-danger'>{$errors['email']}</p>"; ?>
        </div>

        <div style="text-align: center;">
            <button type="submit" id="submit" name="submit" style="padding: 10px 20px; border: none; border-radius: 5px; background-color: #007bff; color: #fff; cursor: pointer;">Update</button>
        </div>
    </form>
</div>

<script>
function validateForm() {
    var number = document.getElementById("number").value;
    var pattern = /^\d{10}$/;
    if (!pattern.test(number)) {
        alert("Please enter exactly 10 digits for the mobile number.");
        return false;
    }
    return true;
}
</script>

<?php
include('include/footer.php');
?>
