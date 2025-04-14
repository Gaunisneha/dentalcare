<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <?php 
    session_start();
    if (!isset($_SESSION['adminname'])) {
        header("Location: adminlogin.php");
        exit();
    }
    include("csslink.php"); 
    $adminname=$_SESSION['adminname'] ;
    include("../class/dataclass.php");
    $dc= new dataclass();
    $totalappointment=$dc->counter("select count(*) from appointment");
    $totaldentist=$dc->counter("select count(*) from dentist");
    $availabledentist=$dc->counter("select count(*) from dentist where status='Active'");


    ?>

</head>
<body>
    
   <?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
  
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Appointment</p>
                                <h6 class="mb-0"><?php echo $totalappointment?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Dentist</p>
                                <h6 class="mb-0"><?php echo $totaldentist?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Available Dentist</p>
                                <h6 class="mb-0"><?php echo $availabledentist?></h6>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
   </div>
   <?php include("footer.php"); ?>
   <?php include("jslink.php"); ?>
</body>
</html>