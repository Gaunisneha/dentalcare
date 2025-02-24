<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    session_start();
    include ("../class/dataclass.php");
     
     ?>
     <?php 
     $appfor="";
     $docid="";
     $name="";
     $emailid="";
     $appdate="";
     $apptime="";
     $remark="";
     $query="";
     $query1="";
     $query2="";
     $msg="";
     $dc=new dataclass();
     ?>
     <?php 
     if(isset($_POST['btn1'])) 
     {
        $appfor=$_POST['appfor'];
        $docid=$_POST['doctors'];
        $patientname=$_POST['patientname'];
        $emailid=$_POST['emailid'];
        $appdate=$_POST['appdate'];
        $apptime=$_POST['apptime'];
        $remark=$_POST['remark'];
        
        $query="INSERT INTO `appointment`(`appfor`, `docid`, `patientname`,`emailid`, `appdate`, `apptime`, `remark`, `status`) VALUES ('$appfor','$docid','$patientname','$emailid','$appdate','$apptime','$remark','Pending')";
        $result=$dc->insertrecord($query);

        if($result)
        {
            // $_SESION['username']=$username;
            // header('location:')
             $msg="Registration successfull!!";
        }
        else
        {
            $msg="Registration unsuccessfull!!";
            die("error".mysqli_error($dc));
        }
     }
     ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php   include("csslink.php") ?>
    
</head>
<body>
<?php   include("topbar.php") ?> 
<?php   include("header.php") ?> 
    <!-- Appointment Start -->
<div class="container-fluid bg-primary bg-appointment my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="display-5 text-white mb-4">We Are A Certified and Award Winning Dental Clinic You Can Trust</h1>
                        <p class="text-white mb-0">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="appointment-form h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">Make Appointment</h1>
                        <form method="post" action="#">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <select name="appfor" class="form-select bg-light border-0" style="height: 55px;">
                                        <option selected>Select Service</option>
                                        <?php
                                        $query2="select serviceid,servicename from services ";
                                        $tb=$dc->gettable($query2);
                                        while($rw=mysqli_fetch_array($tb))
                                        {
                                            if($docid==$rw['serviceid'])
                                            {
                                                echo"<option value=".$rw['serviceid'].">".$rw['servicename']."</option>";
                                            }
                                            else
                                            {
                                                echo"<option value=".$rw['serviceid'].">".$rw['servicename']."</option>";
                                            }
                                        }
                                        ?>
                                        <!-- <option value="1">Service 1</option>
                                        <option value="2">Service 2</option>
                                        <option value="3">Service 3</option> -->
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select name="doctors" class="form-select bg-light border-0" style="height: 55px;">
                                    <option selected>Select Doctor</option>
                                        <?php
                                        $query1="select docid,docname from dentist ";
                                        $tb=$dc->gettable($query1);
                                        while($rw=mysqli_fetch_array($tb))
                                        {
                                            if($docid==$rw['docid'])
                                            {
                                                echo"<option value=".$rw['docid'].">".$rw['docname']."</option>";
                                            }
                                            else
                                            {
                                                echo"<option value=".$rw['docid'].">".$rw['docname']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-light border-0" name="patientname" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-light border-0" name="emailid" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Appointment Date" data-target="#date1" name="appdate" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="time" id="time1" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Appointment Time" data-target="#time1" name="apptime"  data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="textarea" class="form-control bg-light border-0" name="remark" placeholder="Your Remark" style="height: 55px;">
                                </div>
                                
                                <div class="col-12">
                                    <input class="btn btn-dark w-100 py-3" name="btn1" type="submit" value="Make Appointment">
                                </div>
                                <?php echo $msg ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
    <?php   include("footer.php") ?> 
    <?php   include("jsslink.php") ?> 

     <!-- JavaScript Libraries -->
     <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/twentytwenty/jquery.event.move.js"></script>
    <script src="lib/twentytwenty/jquery.twentytwenty.js"></script> -->

    <!-- Template Javascript -->
    <!-- <script src="js/main.js"></script> -->
</body>
</html>


