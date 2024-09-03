<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Rejection Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('../images/Javascript.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 90%;
            max-width: 500px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 16px;
            color: #fff;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-150%) translateY(-150%) rotate(45deg);
            transition: transform 0.5s ease;
        }

        .btn:hover::before {
            transform: translateX(0) translateY(0);
        }

        .btn-dashboard {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .btn-dashboard:hover {
            background: #0056b3;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <?php
    include('connection/db.php');
    $id = $_GET['id'];

    // Fetch data based on job_apply ID
    $sql = "SELECT * FROM job_apply 
            LEFT JOIN all_jobs ON job_apply.id_job = all_jobs.job_id 
            WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);

    if ($row) {
        $applicantEmail = $row['job_seeker'];
    ?>
    <div class="form-container">
        <a href="admin_dashboard.php" class="btn-dashboard">Dashboard</a>
        <form action="adminMail/send_rejection_email.php" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo htmlspecialchars($applicantEmail); ?>" readonly>
            </div>
            <div class="form-group">
                <input type="text" name="subject" class="form-control" placeholder="Subject" value="Job Rejection" readonly>
            </div>
            <div class="form-group">
                <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="send" value="Send Rejection" class="btn">
            </div>
        </form>
    </div>
    <?php
    } 
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
