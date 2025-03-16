<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <?php 
    session_start();
    ?>

</head>
<body>
   <?php include("header.php"); ?>
<!-- Main container for centering the form -->
<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!-- OTP verification form card -->
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">

            <!-- Heading for the form -->
            <h2 class="text-center mb-4">OTP Verification</h2>

            <!-- OTP Form -->
            <form action="#" method="POST">
                
                <!-- OTP input field -->
                <div class="mb-3">
                    <label for="otp" class="form-label">Enter the OTP sent to your email:</label>
                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
                </div>

                <!-- Submit button -->
                <input type="submit" name="verifyotp" class="btn btn-primary w-100" value="Verify OTP"></input>
            </form>

            <!-- Message for errors or success -->
            <?php 
            if (isset($_POST['verifyotp'])) {
                $enteredOtp = $_POST['otp'];

                // Check if the entered OTP matches the OTP stored in session
                if ($enteredOtp == $_SESSION['otp']) {
                    // echo '<div class="alert alert-success mt-3">OTP Verified Successfully! You can now reset your password.</div>';
                    header("location:newpassword.php");
                } else {
                    echo '<div class="alert alert-danger mt-3">Invalid OTP. Please try again.</div>';
                }
            }
            ?>

        </div>
    </div>
</div>

<!-- Link to Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
