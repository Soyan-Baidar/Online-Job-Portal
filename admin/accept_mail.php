<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('../images/image_4.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
        }
        .contact-form {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .contact-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            margin-bottom: 15px;
            padding: 1rem;
            border-radius: 4px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .form-group {
            position: relative;
            overflow: hidden;
        }
        .form-group input, .form-group textarea {
            transition: background-color 0.3s ease;
        }
        .form-group input:hover, .form-group textarea:hover {
            background-color: #f1f1f1;
        }
        .logo {
            text-align: center;
            margin-bottom: 1rem;
        }
        .logo img {
            max-width: 150px; /* Adjust the size as needed */
        }
        .animated-heading {
            text-align: center;
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 2rem;
            animation: fadeInDown 1s ease-in-out;
        }
        @keyframes fadeInDown {
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
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="admin_dashboard.php" class="btn btn-primary btn-sm">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Job Accepted</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="contact-form">
                <div class="logo">
                    <img src="img/Designer.png" alt="Logo">
                </div>
                <h1 class="animated-heading">Job Accepted</h1>
                <form action="adminMail/sendJobMail.php" method="post" class="bg-white p-5 contact-form">
                    <?php
                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
                    } else {
                        $email = '';
                    }
                    ?>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" placeholder="Subject" value="Job Approval" readonly>
                    </div>
                    <div class="form-group">
                        <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="send" value="Send Message" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
<?php if(isset($_GET['status']) && $_GET['status'] === 'success') { ?>
    alert('Email sent successfully!');
<?php } ?>
</script>

</body>
</html>
