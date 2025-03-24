<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php
    session_start();
    include_once('../class/dataclass.php');
    ?>

    <?php
        if (!isset($_SESSION['docid']) || !isset($_SESSION['docname'])) {
        header("Location:doctorlogin.php"); // Redirect if session not found
        exit();
        }
    
        $docid = $_SESSION['docid'];
        $docname = $_SESSION['docname'];
        $msg = "";
        $dc = new DataClass();
    
        if (isset($_POST['reset'])) {
            $newpassword = trim($_POST['newpassword']);
            $confirmpassword = trim($_POST['confirmpassword']);
    
            if ($newpassword === $confirmpassword) {
                $query = "UPDATE dentist SET password='$confirmpassword' WHERE docid='$docid'";
                $result = $dc->updaterecord($query);
                
                if ($result) {
                    $msg = "Password changed successfully!";
                } else {
                    $msg = "Error updating password.";
                }
            } else {
                $msg = "Passwords do not match!";
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
            <h2 class="text-center mb-4">Set New Password</h2>

            <!-- Form starts here -->
            <form action="#" method="POST">
                
                <!-- New Password input field -->
                <div class="mb-3">
                    <label for="newpassword" class="form-label">New Password:</label>
                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter new password" required>
                </div>

                <!-- Confirm Password input field -->
                <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm new password" required>
                </div>

                <!-- Submit button -->
                <button type="submit" name="reset" class="btn btn-primary w-100">Reset Password</button>
                <div class="mb-3">
                <?php echo $msg ?>
                </div>
                <div class="mb-3">
                <input type="submit" name="back" class="btn btn-danger "value="Login" ></button>
                </div>
            </form>

            <!-- Display message for errors or success -->
            

        </div>
    </div>
</div>

<!-- Link to Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
