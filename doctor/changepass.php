
<?php
session_start();
include("../class/dataclass.php");

$docid = $_SESSION['docid'];
$docname = $_SESSION['docname'];
$oldpassword = "";
$newpassword = "";
$confirmpassword = "";
$query = "";
$msg = "";
$dc = new dataclass();

if (isset($_POST['change'])) {
    $oldpassword = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $query = "SELECT password FROM dentist WHERE docname='$docname'";
    $rw = $dc->getrow($query);
    
    if ($rw) {
        if ($oldpassword == $rw['password'])
         {
            if ($newpassword == $confirmpassword) 
            {
                $query = "UPDATE dentist SET password='$newpassword' WHERE docid='$docid'";
                $result = $dc->updaterecord($query);
                if ($result) 
                {
                    $msg = "Password changed successfully.";
                    header('location:profile.php');
                } else 
                {
                    $msg = "Password not changed.";
                }
            } else {
                $msg = "New password and confirmation do not match.";
            }
        } else {
            $msg = "Invalid old password.";
        }
    } else {
        $msg = "Record not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 50px;
        }

        .card {
            max-width: 500px;
            margin: auto;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.5);
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h3>Change Password</h3>
        </div>
        <div class="card-body">
            <form id="changePasswordForm" method="POST" action="#">
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="docname" class="form-control" id="username" name="docname" 
                    value="<?php echo($docname)?>"required>
                </div>
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newpassword" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmpassword" required>
                </div>
                <input type="submit" name="change" class="btn btn-primary w-100" value="Change Password">
            </form>
            <!-- Displaying message -->
            <?php if ($msg): ?>
                <div class="alert alert-info mt-3"><?php echo $msg; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
