<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start();
        include("../class/dataclass.php");
    ?>
    <?php
        $docid = "";
        $docname = "";
        $contactno = "";
        $emailid = "";
        $password = "";
        $qualification = "";
        $experience = "";
        $speciality = "";
        $aboutus = "";
        $dc = new dataclass();
        $query = "";
        $msg = ""; 
    ?>
    
    <?php    
        if(isset($_POST['bsave'])){
            $docname = $_POST['docname'];
            $contactno = $_POST['contactno'];
            $emailid = $_POST['emailid'];
            $qualification = $_POST['qualification'];
            $experience = $_POST['experience'];
            $speciality = $_POST['appfor'];
            $aboutus = $_POST['aboutus'];
            $password = $_POST['password'];
            $filename = $_FILES['image']['name'];
            $tmpname = $_FILES['image']['tmp_name'];

            $query = "INSERT INTO `dentist`( `docname`, `contactno`, `emailid`, `password`, `qualification`, `experience`, `speciality`, `aboutus`, `image`, `status`) 
                      VALUES ('$docname', '$contactno', '$emailid', '$password', '$qualification', '$experience', '$speciality', '$aboutus', '$filename', 'Pending')";
            $result = $dc->insertrecord($query);

            if (!$result) {
                $msg = "Record not inserted";
            }

            if ($result) {
                header('Location: doctorlogin.php');
                move_uploaded_file($tmpname, '../home/img/'.$filename);
            }
        }
        if(isset($_POST['bcancel'])){
            header("loction:../doctorlogin.php");
        }
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the form */
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control, .form-select, textarea {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .form-control:focus, .form-select:focus {
            border-color: #5c7cfa;
            box-shadow: 0 0 0 0.25rem rgba(82, 153, 255, 0.25);
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <form action="#" method="POST" enctype="multipart/form-data">
        <h2>Dentist Registration</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="docname">Docname</label>
                    <input type="text" class="form-control" id="docname" name="docname" value='<?php echo $docname ?>' autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="contactno">Contact No</label>
                    <input type="text" class="form-control" id="contactno" name="contactno" value='<?php echo $contactno ?>'>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="emailid">Email ID</label>
                    <input type="email" class="form-control" id="emailid" name="emailid" value='<?php echo $emailid ?>'>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value='<?php echo $password ?>'>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="qualification">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification" value='<?php echo $qualification ?>'>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="experience">Experience</label>
                    <input type="text" class="form-control" id="experience" name="experience" value='<?php echo $experience ?>'>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="speciality">Speciality</label>
                    <select name="appfor" id="speciality" class="form-select">
                        <option selected>Select Service</option>
                        <?php
                        $query2 = "SELECT serviceid, servicename FROM services";
                        $tb = $dc->gettable($query2);
                        while ($rw = mysqli_fetch_array($tb)) {
                            echo "<option value='".$rw['servicename']."'>".$rw['servicename']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="aboutus">About Us</label>
                    <textarea class="form-control" id="aboutus" name="aboutus" rows="5"><?php echo $aboutus ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <input type="submit" class="btn btn-success " name="bsave" value="Save">
            <input type="submit" class="btn btn-danger " name="bcancel" value="Cancel">
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
