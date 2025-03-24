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
        .form-control {
            border: 1px solid black;
        }
        .form-section {
            margin: 30px 0;
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
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <h2 class="ps-4">Edit User Profile</h2>
                                <?php if ($msg) { echo "<p class='alert alert-danger'>$msg</p>"; } ?>
                            </div>

                            <div class="col-md-6">
                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="username" value='<?php echo $username ?>' autofocus>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Emailid</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="emailid" value='<?php echo $emailid ?>'>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Contactno</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="contactno" value='<?php echo $contactno ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Gender</label>
                                    <div class="col-md-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Address</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="address"><?php echo $address ?></textarea>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input name="image" type="file" class="form-control" value="<?php echo $filename ?>">
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
