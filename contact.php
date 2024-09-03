<?php 
$page = 'contact';
include('include/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success'): ?>
            <script>showAlert('Message sent successfully!');</script>
        <?php else: ?>
            <script>showAlert('Failed to send message.');</script>
        <?php endif; ?>
    <?php endif; ?>

    <div class="hero-wrap js-fullheight" style="background-image: url('images/first.jpeg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" data-scrollax-parent="true">
                <div class="col-md-8 ftco-animate text-center text-md-left mb-5" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact</span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Contact Us</h1>
                </div>
            </div>
        </div>
    </div>

    <section style="background-color: #f8f9fa; padding: 50px 0;" class="ftco-section contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="h3">Contact Information</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <p style="margin-bottom: 20px;"><strong>Address:</strong><br> Banepa, Kavrepalanchok</p>
                </div>
                <div class="col-md-4 text-center">
                    <p style="margin-bottom: 20px;"><strong>Phone:</strong><br> <a href="tel://9999999999">+977 9999999999</a></p>
                </div>
                <div class="col-md-4 text-center">
                    <p style="margin-bottom: 20px;"><strong>Email:</strong><br> <a href="mailto:jobbloom_info@gmail.com">jobbloominfo@gmail.com</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="mail/send.php" method="post" class="bg-white p-5 contact-form" style="border: 1px solid #e5e5e5; border-radius: 5px;">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" style="margin-bottom: 15px;" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" style="margin-bottom: 15px;" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" style="margin-bottom: 15px;" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" cols="30" rows="7" class="form-control" style="margin-bottom: 15px;" placeholder="Message" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="send" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include('include/footer.php'); ?>
</body>
</html>
