<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Profile</title>
  <?php include('csslink.php');?>
  
<?php 
    session_start();
    include ("../class/dataclass.php");
    $dc=new dataclass();
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
    ?>
<body>
  
  <section style="background-color: #eee;" class="container w-70% py-5">
    <div class="container w-70% py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="../doctor/doctorhome.php">Home</a></li>
              <li class="breadcrumb-item"><a href="../doctor/doctorform.php">Doctor</a></li>
              <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
            </ol>
          </nav>
        </div>
      </div>

     

      <div class="row ">
        <div class="col-lg-4">
          <div class="card mb-4">
            <!-- <div class="card-body text-center">
              <img src="./" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"></h5>
              <div class="d-flex justify-content-center mb-2">
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Add Image
                </button>
              </div> -->
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <!-- Full Name -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $docname;?></p>
                </div>
              </div>
              <hr>

              <!-- Email -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $emailid;?></p>
                </div>
              </div>
              <hr>
 
              <!-- Password -->
              <!-- <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Password</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">********</p>
                </div>
              </div>
              <hr>  -->

              <!-- Specialization -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Specialization</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $speciality;?></p>
                </div>
              </div>
              <hr>

              <!-- Contact No -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Contact No</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $contactno;?></p>
                </div>
              </div>
              <hr>

              <!-- Gender -->
              <!-- <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Gender</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $gender;?></p>
                </div>
              </div>
              <hr> -->

              <!-- City -->
              <!-- <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">City</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $city;?></p>
                </div>
              </div>
              <hr> -->

              <!-- Address -->
              <!-- <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $address;?></p>
                </div>
              </div>
              <hr> -->

              <!-- Status -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Status</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $status;?></p>
                </div>
              </div>
              <hr>

              <!-- About Us -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">About Us</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $aboutus;?></p>
                </div>
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
