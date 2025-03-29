<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("csslink.php"); ?>
    <?php 
    // session_start();
    include ("../class/dataclass.php");
    $dc=new dataclass();
    $totalappointment=$dc->counter("select count(*) from appointment");
    

    // $docid= $_SESSION['docid'] ; 
    // $docname= $_SESSION['docname'] ; 
    //  ?>
</head>
<body>
   <?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
   
  
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

   

<!--        
              <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                   
                </div>
            </div> -->
            
            <?php include("footer.php"); ?>
   </div>
   
   <?php include("jslink.php"); ?>
</body>
</html>