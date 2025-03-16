<?php
session_start();
include("../class/dataclass.php");
$dc = new dataclass();
$msg = "";

// Get token from URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token is valid
    $query = "SELECT * FROM password_reset WHERE token='$token' AND exp_time >= NOW()";
    $result = $dc->getrow($query);

    if ($result) {
        $_SESSION['reset_email'] = $result['email'];
    } else {
        die("Invalid or expired token.");
    }
}

// Handle password reset
if (isset($_POST['submit'])) {
    $newPassword = $_POST['password'];
    $email = $_SESSION['reset_email'];

    // Update password in registration table
    $updateQuery = "UPDATE registration SET password='$newPassword' WHERE emailid='$email'";
    $dc->updaterecord($updateQuery);

    // Remove token from password_reset table
    $deleteQuery = "DELETE FROM password_reset WHERE email='$email'";
    $dc->deleterecord($deleteQuery);

    $msg = "Password reset successful! <a href='login.php'>Login now</a>";
}
?>

<!-- Reset Password Form -->
<form method="POST" action="">
    <h2>Reset Password</h2>
    <input type="password" name="password" placeholder="Enter new password" required>
    <input type="submit" name="submit" value="Reset Password">
</form>
<p><?php echo $msg; ?></p>
