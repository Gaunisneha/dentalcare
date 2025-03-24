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
            $msg = "Doctor not found.";
        }
    }
   

   if(isset($_POST['cancel'])){
    header('location:profile.php');
   }
   ?>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control {
            border: 1px solid black;
        }
    </style>
</head>

<body>
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
                        </div>
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
