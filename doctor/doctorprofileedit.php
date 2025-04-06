<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include("../class/dataclass.php");

    // Initialize variables
    $docid = "";
    $docname = "";
    $contactno = "";
    $emailid = "";
    $qualification = "";
    $experience = "";
    $speciality = "";
    $aboutus = "";
    $filename = "";
    $msg = "";
    $dc = new dataclass();
    $query = "";

    // Ensure docid exists in session
    if (isset($_SESSION['docid'])) {
        $docid = $_SESSION['docid'];
    } else {
        // Redirect if docid is not available
        header('Location: showdoctor.php');
        exit();
    }

    // Fetch dentist details if docid is valid
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        // Fetch data from form
        $docname = $_POST['docname'];
        $contactno = $_POST['contactno'];
        $emailid = $_POST['emailid'];
        $qualification = $_POST['qualification'];
        $experience = $_POST['experience'];
        $speciality = $_POST['speciality'];
        $aboutus = $_POST['aboutus'];
        $filename = "";

        // Handle image upload if file is chosen
        if ($_FILES['image']['name'] != "") {
            $filename = $_FILES['image']['name'];
            $tmpname = $_FILES['image']['tmp_name'];
            $upload_dir = '../img/';
            
            // Ensure the file is uploaded correctly
            if (move_uploaded_file($tmpname, $upload_dir . $filename)) {
                // File upload success
            } else {
                $msg = "File upload failed.";
            }
        }

        // Update dentist record in database
        $query = "UPDATE dentist SET docname='$docname', contactno='$contactno', emailid='$emailid', 
                  qualification='$qualification', experience='$experience', speciality='$speciality', 
                  aboutus='$aboutus', image='$filename' WHERE docid='$docid'";

        $result = $dc->updaterecord($query);

        if ($result) {
            // Redirect to profile page on successful update
            header('Location: profile.php');
            exit();
        } else {
            $msg = "Error updating record.";
        }
    }

    // Retrieve dentist details to populate the form if necessary
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query = "SELECT * FROM dentist WHERE docid='$docid'";
        $rw = $dc->getrow($query);

        if ($rw) {
            $docname = $rw['docname'];
            $contactno = $rw['contactno'];
            $emailid = $rw['emailid'];
            $qualification = $rw['qualification'];
            $experience = $rw['experience'];
            $speciality = $rw['speciality'];
            $aboutus = $rw['aboutus'];
            $filename = $rw['image'];
        } else {
            $msg = "Dentist not found.";
        }
    }
   

   if(isset($_POST['cancel'])){
    header('location:profile.php');
   }
   ?>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background: linear-gradient(to right, #eef2f3, #8ec5fc);
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
            max-width: 800px;
        }

        h2 {
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 3px solid #3498db;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #2c3e50;
        }

        .form-control {
            border: 2px solid #d1d9e6;
            border-radius: 5px;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0px 0px 8px rgba(52, 152, 219, 0.5);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #3498db;
            display: block;
            margin: 10px auto;
            box-shadow: 0px 5px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-custom {
            width: 150px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            border-radius: 50px;
        }

        .btn-success {
            background: #28a745;
            border: none;
        }

        .btn-success:hover {
            background: #218838;
            box-shadow: 0px 5px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-danger {
            background: #c82333;
            border: none;
        }

        .btn-danger:hover {
            background: #a71d2a;
            box-shadow: 0px 5px 15px rgba(200, 35, 51, 0.3);
        }

        .text-center {
            text-align: center;
        }
       
    </style>
   <script>
    function validateName() {
        let name = document.getElementById("docname").value;
        let error = document.getElementById("error-name");
        let regex = /^[A-Za-z\s]+$/;

        if (name.trim() === "") {
            error.textContent = "Name is required.";
        } else if (!regex.test(name)) {
            error.textContent = "Only alphabets and spaces are allowed.";
        } else {
            error.textContent = "";
        }
    }

    function validateContact() {
        let contact = document.getElementById("contactno").value;
        let error = document.getElementById("error-contact");
        let regex = /^[0-9]{10}$/;

        if (contact.trim() === "") {
            error.textContent = "Contact number is required.";
        } else if (!regex.test(contact)) {
            error.textContent = "Must be a 10-digit number.";
        } else {
            error.textContent = "";
        }
    }

    function validateEmail() {
        let email = document.getElementById("emailid").value;
        let error = document.getElementById("error-email");
        let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (email.trim() === "") {
            error.textContent = "Email is required.";
        } else if (!regex.test(email)) {
            error.textContent = "Invalid email format.";
        } else {
            error.textContent = "";
        }
    }

    function validateQualification() {
        let qualification = document.getElementById("qualification").value;
        let error = document.getElementById("error-qualification");

        if (qualification.trim() === "") {
            error.textContent = "Qualification is required.";
        } else {
            error.textContent = "";
        }
    }

    function validateExperience() {
        let experience = document.getElementById("experience").value;
        let error = document.getElementById("error-experience");

        if (experience.trim() === "") {
            error.textContent = "Experience is required.";
        } else if (experience < 2) {
            error.textContent = "You must have at least 2 years of Experience.";
        } else {
            error.textContent = "";
        }
    }

    function validateSpeciality() {
        let speciality = document.getElementById("speciality").value;
        let error = document.getElementById("error-speciality");

        if (speciality.trim() === "") {
            error.textContent = "Speciality is required.";
        } else {
            error.textContent = "";
        }
    }

    function validateAboutUs() {
        let aboutus = document.getElementById("aboutus").value;
        let error = document.getElementById("error-aboutus");

        if (aboutus.trim() === "") {
            error.textContent = "This field cannot be empty.";
        } else {
            error.textContent = "";
        }
    }

    function validateForm(event) {
        validateName();
        validateContact();
        validateEmail();
        validateQualification();
        validateExperience();
        validateSpeciality();
        validateAboutUs();

        let errors = document.querySelectorAll(".error");
        for (let i = 0; i < errors.length; i++) {
            if (errors[i].textContent !== "") {
                event.preventDefault(); // Stop form submission if there are errors
                return false;
            }
        }
        return true;
    }

    document.getElementById("dentistForm").addEventListener("submit", validateForm);
</script>

  
</head>

<body>
  

<div class="container mt-5">
        <h2 class="text-center">🦷 Update Dentist Profile</h2>
        <?php if ($msg) { echo "<div class='alert alert-danger'>$msg</div>"; } ?>

        <form id="dentistForm" action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Left Side -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="docname" name="docname" value="<?= $dentist['docname'] ?? '' ?>" oninput="validateName()" >
                        <span id="error-name" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact No</label>
                        <input type="text" class="form-control" id="contactno"  name="contactno" value="<?= $dentist['contactno'] ?? '' ?>">
                        <span id="error-contact" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailid" name="emailid" value="<?= $dentist['emailid'] ?? '' ?>" >
                        <span id="error-email" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" value="<?= $dentist['qualification'] ?? '' ?>">
                        <span id="error-qualification" class="error"></span>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Experience (Years)</label>
                        <input type="number" class="form-control" id="experience" name="experience" value="<?= $dentist['experience'] ?? '' ?>">
                        <span id="error-experience" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Speciality</label>
                        <input type="text" class="form-control" id="speciality" name="speciality" value="<?= $dentist['speciality'] ?? '' ?>" >
                        <span id="error-speciality" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">About</label>
                        <textarea class="form-control" id="aboutus" name="aboutus" rows="3"><?= $dentist['aboutus'] ?? '' ?></textarea>
                        <span id="error-aboutus" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Image</label>
                        <input type="file" class="form-control" name="image">
                        <br>
                        <?php if (!empty($dentist['image'])) { ?>
                            <img src="../img/<?= $dentist['image'] ?>" class="profile-img" alt="Profile Image">
                        <?php } else { ?>
                            <!-- <img src="#" class="profile-img" alt=""> -->
                        <?php } ?>
                    </div>
                </div>
            </div>

<!-- 



    <div class="content">
        <form action="#" method="POST" enctype="multipart/form-data">
            <main id="main" class="container">
                <section class="section dashboard">
                    <div class="row">
                        <div class="row m-5">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <h2 class="ps-4">Dentist Form</h2>
                                <?php if ($msg) { echo "<p class='alert alert-danger'>$msg</p>"; } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Docname</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="docname" value='<?php echo $docname ?>' autofocus>
                                    </div>
                                </div>

                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Contactno</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="contactno" value='<?php echo $contactno ?>'>
                                    </div>
                                </div>

                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Emailid</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="emailid" value='<?php echo $emailid ?>'>
                                    </div>
                                </div>

                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Qualification</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="qualification" value='<?php echo $qualification ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Experience</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="experience" value='<?php echo $experience ?>'>
                                    </div>
                                </div>

                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Speciality</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="speciality" value='<?php echo $speciality ?>'>
                                    </div>
                                </div>

                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Aboutus</label>
                                    <div class="col-md-9">
                                        <textarea placeholder="Write here" name="aboutus" cols="56" rows="5"><?php echo $aboutus ?></textarea>
                                    </div>
                                </div>

                                <div class="row-md-3">
                                    <label class="col-md-3 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input name="image" type="file" class="form-control"  value="<?php echo $filename ?>">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-success m-3" name="update" value='Save'>
                                <input type="submit" class="btn btn-danger m-3" name="cancel" value='Cancel'>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </form>
    </div>
</body>

</html>
