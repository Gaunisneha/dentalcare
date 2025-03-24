<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <?php 
    include_once('../class/dataclass.php'); 
    session_start();
    ob_start();
   
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';
    ?>

    <?php
        $docid="";
        $docname="";
        $password="";
        $usertype="";
        $msg="";
        $query="";
        $dc=new DataClass();
    ?>
    <?php
        if (isset($_POST['forgotpassword'])) {
            $emailid = trim($_POST['emailid'] ?? '');

            if (!empty($emailid)) {
                $emailid = mysqli_real_escape_string($dc->getConnection(), $emailid);
                $query = "SELECT docid, emailid FROM dentist WHERE emailid = '$emailid'";
                $row = $dc->getRow($query);

                if ($row) {
                    $otp = rand(100000, 999999);
                    $_SESSION['docid'] = $row['docid'];
                    $_SESSION['emailid'] = $row['emailid'];
                    $_SESSION['otp'] = $otp;

                    // Update OTP in database
                    $sql = "UPDATE dentist SET otp='$otp' WHERE emailid='{$row['emailid']}'";
                    $dc->updaterecord($sql);

                    // Send OTP via PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        // Set up PHPMailer
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username='manasiyamosinali1@gmail.com';             
                        $mail->Password ='rzjdcgybzphcttog'; 
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('manasiyamosinali1@gmail.com', 'Dental Care');
                        $mail->addAddress($row['emailid']); // Recipient's email

                        $mail->isHTML(true);
                        $mail->Subject = 'OTP Verification';
                        $mail->Body = "<p>Your OTP for password reset is: <b>$otp</b></p>";

                        // Debugging output
                        $mail->SMTPDebug = 2;  // Set to 2 to get detailed debug output in case of failure.

                        $mail->send();

                        // Redirect to OTP page
                        header('Location: otp.php');
                        exit();
                    } catch (Exception $e) {
                        $msg = "OTP sending failed: " . $mail->ErrorInfo;
                    }
                } else {
                    $msg = "Email is not registered.";
                }
            } else {
                $msg = "Enter your email before trying to reset the password.";
            }
        }
    ?>
</head>
<body>

<!-- Main container for centering the form -->
<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!-- Form card -->
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">

            <!-- Heading for the form -->
            <h2 class="text-center mb-4">Forgot Password</h2>

            <!-- Form starts here -->
            <form action="#" method="POST">
                
                <!-- Email input field -->
                <div class="mb-3">
                    <label for="emailid" class="form-label">Enter your email address:</label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Email" required>
                </div>

                <!-- Submit button -->
                <input type="submit" name="forgotpassword" class="btn btn-primary w-100" value="Submit"></input>
            </form>

            <!-- Display message -->
            <?php if (!empty($msg)) { ?>
                <div class="alert alert-danger mt-3"><?php echo $msg; ?></div>
            <?php } ?>

        </div>
    </div>
</div>

<!-- Link to Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
