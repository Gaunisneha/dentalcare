<!DOCTYPE html>
<html lang="en">
    

<head>
    <?php
    session_start();
    include("../class/dataclass.php");

    $docid = "";
    $username = "";
    $contactno = "";
    $emailid = "";
    $gender = "";
    $address = "";
    $filename = "";
    $msg = "";
    $dc = new dataclass();
    $query = "";

    if (isset($_SESSION['regid'])) {
        $docid = $_SESSION['regid'];
    } else {
        header('Location: profiletem.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $username = $_POST['username'];
        $contactno = $_POST['contactno'];
        $emailid = $_POST['emailid'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];

        if ($_FILES['image']['name'] != "") {
            $filename = $_FILES['image']['name'];
            $tmpname = $_FILES['image']['tmp_name'];
            $upload_dir = 'img/';
            
            if (move_uploaded_file($tmpname, $upload_dir . $filename)) {
            } else {
                $msg = "File upload failed.";
            }
        }

        $query = "UPDATE registration SET username='$username', emailid='$emailid', contactno='$contactno',
                  gender='$gender', address ='$address', image='$filename' WHERE regid='$docid'";

        $result = $dc->updaterecord($query);

        if ($result) {
            header('Location: profiletem.php');
            exit();
        } else {
            $msg = "Error updating record.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query = "SELECT * FROM registration WHERE regid='$docid'";
        $rw = $dc->getrow($query);

        if ($rw) {
            $username = $rw['username'];
            $emailid = $rw['emailid'];
            $contactno = $rw['contactno'];
            $gender = $rw['gender'];
            $address = $rw['address'];
            $filename = $rw['image'];
        } else {
            $msg = "User not found.";
        }
    }

    if (isset($_POST['cancel'])) {
        header('location:profiletem.php');
    }
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            /* padding: 20px; */
        }

        .container {
            width: 40%;
            /* width: 50%; */
            background: white;
            padding: 20px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .input-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .input-group input,
        .input-group textarea,
        .input-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-group input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }

        .gender-group {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 3px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .error {
            color: red;
            font-size: 0.9em;
            font-weight: bold;
        }
        .alert {
            color: red;
            text-align: center;
        }
    </style>
   
</head>

<body>
      
<div class="container">
        <h2>Edit User Profile</h2>
        <?php if ($msg) { echo "<p class='alert'>$msg</p>"; } ?>
        <form action="#" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" id="username" value='<?php echo $username ?>' autofocus>
                <span class="error" id="usernameError"></span>
            </div>

            <div class="input-group">
                <label>Email ID</label>
                <input type="text" name="emailid" id="emailid" value='<?php echo $emailid ?>'>
                <span class="error" id="emailError"></span>
            </div>

            <div class="input-group">
                <label>Contact No</label>
                <input type="text" name="contactno" id="contactno" value='<?php echo $contactno ?>'>
                <span class="error" id="contactError"></span>
            </div>

            <div class="input-group">
                <label>Gender</label>
                <div class="gender-group">
                    <input type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>> Male
                    <input type="radio" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>> Female
                </div>
            </div>

            <div class="input-group">
                <label>Address</label>
                <textarea name="address" id="address"><?php echo $address ?></textarea>
                <span class="error" id="addressError"></span>
            </div>

            <div class="input-group">
                <label>Profile Image</label>
                <input name="image" type="file" id="image">
                <span class="error" id="imageError"></span>
            </div>

            <div class="button-group">
                <input type="submit" class="btn btn-success" name="update" value='Save'>
                <input type="submit" class="btn btn-danger" name="cancel" value='Cancel'>
            
            </div>
        </form>
    </div>

   
    </div>
    <script>
        function validateInput(input, pattern, errorElement, errorMessage) {
            if (!pattern.test(input.value)) {
                errorElement.textContent = errorMessage;
                return false;
            } else {
                errorElement.textContent = "";
                return true;
            }
        }

        document.getElementById("username").addEventListener("input", function() {
            validateInput(this, /^[A-Za-z\s]{3,}$/, document.getElementById("usernameError"), "Username must be at least 3 characters long and contain only letters.");
        });

        document.getElementById("contactno").addEventListener("input", function() {
            validateInput(this, /^\d{10}$/, document.getElementById("contactError"), "Enter a valid 10-digit contact number.");
        });

        document.getElementById("emailid").addEventListener("input", function() {
            validateInput(this, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, document.getElementById("emailError"), "Enter a valid email address.");
        });

        document.getElementById("address").addEventListener("input", function() {
            validateInput(this, /^.{5,}$/, document.getElementById("addressError"), "Address must be at least 5 characters long.");
        });

        function validateImage() {
        var imageInput = document.getElementById("image");
        var errorElement = document.getElementById("imageError");
        var file = imageInput.files[0];

        if (!file) {
            errorElement.textContent = "Please select an image file.";
            return false;
        }

        var allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        var fileExtension = file.name.split('.').pop().toLowerCase();
        var fileSize = file.size / 1024 / 1024; 

        if (!allowedExtensions.includes(fileExtension)) {
            errorElement.textContent = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            return false;
        }

        if (fileSize > 2) {
            errorElement.textContent = "File size must be less than 2MB.";
            return false;
        }

        errorElement.textContent = "";
        return true;
    }

    document.getElementById("image").addEventListener("change", validateImage);

        function validateForm() {
            var usernameValid = validateInput(document.getElementById("username"), /^[A-Za-z\s]{3,}$/, document.getElementById("usernameError"), "Username must be at least 3 characters long and contain only letters.");
            var emailValid = validateInput(document.getElementById("emailid"), /^[^\s@]+@[^\s@]+\.[^\s@]+$/, document.getElementById("emailError"), "Enter a valid email address.");
            var contactValid = validateInput(document.getElementById("contactno"), /^\d{10}$/, document.getElementById("contactError"), "Enter a valid 10-digit contact number.");
            var addressValid = validateInput(document.getElementById("address"), /^.{5,}$/, document.getElementById("addressError"), "Address must be at least 5 characters long.");

            if (!usernameValid || !emailValid || !contactValid || !addressValid || !imageValid) {
                document.getElementById("formError").textContent = "Please fix errors before submitting.";
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
