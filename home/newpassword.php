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
        if (!isset($_SESSION['regid']) || !isset($_SESSION['username'])) {
        header("Location: loginpage.php"); 
        exit();
        }
    
        if(isset($_POST['back'])){
            header("location:loginpage.php");
        }
    
        $regid = $_SESSION['regid'];
        $username = $_SESSION['username'];
        $msg = "";
        $dc = new DataClass();

       
        if (isset($_POST['reset'])) {
            $newpassword = trim($_POST['newpassword']);
            $confirmpassword = trim($_POST['confirmpassword']);
    
            if ($newpassword === $confirmpassword) {
                $query = "UPDATE registration SET password='$confirmpassword' WHERE regid='$regid'";
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
                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter new password">
                </div>

                <!-- Confirm Password input field -->
                <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm new password">
                </div>

                <!-- Submit button -->
                <button type="submit" name="reset" class="btn btn-primary w-100">Reset Password</button>
                <div class="mb-3">
                <?php echo $msg ?>
                </div>
                <div class="mb-3">
                <input type="submit" name="back" id="back" class="btn btn-danger "value="Login" ></input>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Link to Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
