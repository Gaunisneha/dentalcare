<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dentist Profile</title>
  <?php include('csslink.php'); ?>
  <style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 75%;
    margin: auto;
    padding: 20px;
}

.card {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}
.header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* background-color: #007bff; */
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
        }

.card-body {
    padding: 20px;
}

h5 {
    font-size: 1.2rem;
    font-weight: bold;
}

.text-muted {
    font-size: 1rem;
    color: #6c757d;
}

hr {
    margin: 10px 0;
    border-top: 1px solid #ddd;
}

.breadcrumb {
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.btn {
    padding: 10px 15px;
    font-size: 1rem;
    border-radius: 5px;
}

.btn-warning {
    background-color: #ff9800;
    border: none;
}

.btn-info {
    background-color: #17a2b8;
    border: none;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn:hover {
    opacity: 0.8;
}

.text-center img {
    width: 150px;
    border-radius: 50%;
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .container {
        max-width: 95%;
    }
}

  </style>
 
  <body>
<?php 
    session_start();
    include ("../class/dataclass.php");
    $dc=new dataclass();
    if (!isset($_SESSION['docid'])) {
      header("Location: doctorlogin.php"); // Redirect if not logged in
      exit();
  }
   ?>
  <?php
  $docid="";
  $docname="";
  $contactno="";
  $emailid="";
  $qualification="";
  $experience="";
  $speciality="";
  $status="";
  $aboutus="";
  $address="";
  $gender="";
  $city="";
  ?>
  
  <?php 
    $docid=$_SESSION['docid'];
    $query="select * from dentist where docid='$docid'";
    $rw=$dc->getrow($query);
   
        $docname=$rw['docname'];
        $contactno=$rw['contactno'];
        $emailid=$rw['emailid'];
        $qualification=$rw['qualification'];
        $experience=$rw['experience'];
        $speciality=$rw['speciality'];
        $status=$rw['status'];
        $aboutus=$rw['aboutus'];
        // $address = $rw['address'];
        // $gender = $rw['gender'];
        // $city = $rw['city'];
    ?>
     
<section class="container py-5">
  
<div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar pe-4 pb-3">
                    <nav class="navbar bg-light navbar-light">
                        <a href="index.html" class="navbar-brand mx-4 mb-3">
                            <h3 class="m-0 text-primary"><i class="fa fa-tooth me-2"></i>Dental Care</h3>
                        </a>
                        <div class="navbar-nav w-100">
                            <a href="doctorhome.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                            <a href="doctor_schedule.php" class="nav-item nav-link"><i class="fa fa-user-nurse"></i>Dentist Schedule</a>
                            <a href="appointment.php" class="nav-item nav-link"><i class="fa fa-calendar-check"></i>Appointments</a>
                        </div>
                    </nav>
                </div>
            </div>
        <!-- Breadcrumb Navigation -->
        <!-- <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="../doctor/doctorhome.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="../doctor/doctorform.php">Doctor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
         -->

      <div class="col-lg-8">
                    <div class="card mb-4 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4"><strong>Full Name</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $docname; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>Email</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $emailid; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>Contact No</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $contactno; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>Specialization</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $speciality; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>Experience</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $experience; ?> Years</div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>Qualification</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $qualification; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>Address</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $address . ", " . $city; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>Status</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $status; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4"><strong>About Me</strong></div>
                                <div class="col-sm-8 text-muted"><?php echo $aboutus; ?></div>
                            </div>
                        </div>
                    </div>

     

        

          <!-- Buttons for Edit, Change Password, and Exit -->
          <div class="d-flex justify-content-between">
           <a href="../doctor/doctorprofileedit.php"><button type="button" class="btn btn-warning">Edit Profile</button></a>
           <a href="../doctor/changepass.php"> <button type="button" class="btn btn-info">Change Password</button></a>
           <a a href="../doctor/doctorhome.php"> <input type="button" class="btn btn-danger" href="doctorhome.php" value="exit"></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
