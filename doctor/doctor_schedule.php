<!DOCTYPE html>

<html lang="en">
<head>

     <?php 
        session_start();
        include("../class/dataclass.php");
    ?>
    <?php
        $scheduleid="";
        $docname="";
        $available_days="";
        $start_time="";
        $end_time="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
        $result="";
    ?>
    
    <?php    
        if(isset($_POST['bsave'])){
            $docname=$_POST['docname'];
            $available_days=$_POST['available_days'];
            $start_time=$_POST['start_time'];
            $end_time=$_POST['end_time'];

              $query = "INSERT INTO `doctor_schedule`(`docname`, `available_days`, `start_time`, `end_time`) VALUES ('$docname','$available_days','$start_time','$end_time')";

            $result = $dc->insertrecord($query);

            if (!$result) {
                $msg = "Record not inserted";
            }

           
        }
        if(isset($_POST['bcancel'])){
            header("loction:../doctor/doctorhome.php");
        }
    ?>

   
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control{
            border:1px solid black;
        }
    </style>
</head>
<body>

   <div class="content">

   <form action="#" method="POST">
        <main id="main" class="container">
            <section class="section dashboard">
                
            <div class="row">
            <div class="row m-5">
                <div class="col-md-4">
                </div>
                    <div class="col-md-8">
                    <h2 class="ps-4">Dentist Form</h2>
                    </div>
            <div class="col-md-6">


                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Docname</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="docname" value='<?php echo $docname ?>' autofocus>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">available_days</label>
                    <div class="col-md-9">
                    <input type="date" class="form-control" name="available_days" value='<?php echo $available_days?>'>
                    </div>
                </div>
                
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">start_time</label>
                    <div class="col-md-9">
                    <input type="time" class="form-control" name="start_time" value='<?php echo $start_time?>'>
                    </div>
                </div>
       
                </div>
                <div class="col-md-6">
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">end_time</label>
                    <div class="col-md-9">
                    <input type="time" class="form-control" name="end_time" value='<?php echo $end_time?>'>
                    </div>
                </div>

                

                </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center ">
                    <input type="submit" class="btn btn-success m-3" name="bsave" value='save' >
                    <a href="doctorhome.php"></a><input type="submit" class="btn btn-danger m-3" name="bcancel" value='cancel'>
                    </div>
                </div>
            </section>       
</main>
    </form>
   </div>
</body>
</html>