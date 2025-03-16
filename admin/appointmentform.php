<!DOCTYPE html>

<html lang="en">
<head>
 <?php 
     session_start();
     include("../class/dataclass.php");
     ?>
     <?php
        $appid="";
        $appfor="";
        $docid="";
        $patientname="";
        $emailid="";
        $appdate="";
        $appdate="";
        $apptime="";
        $remark="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
     ?>

     <?php    
        if($_SESSION['trans']=='update')
        {
            $appid=$_SESSION['appid'];
            $query="SELECT * FROM `appointment` WHERE  appid='$appid'";
            $rw=$dc->getrow($query);
            $appfor=$rw['appfor'];
            $docid=$rw['docid'];
            $patientname=$rw['patientname'];
            $emailid=$rw['emailid'];
            $appdate=$rw['appdate'];
            $apptime=$rw['apptime'];
            $remark=$rw['remark'];
            $status=$rw['status'];
        }

        if(isset($_POST['bsave']))
        {
            $appfor=$_POST['appfor'];
            $docid=$_POST['docid'];
            $patientname=$_POST['patientname'];
            $emailid=$_POST['emailid'];
            $appdate=$_POST['appdate'];
            $apptime=$_POST['apptime'];
            $remark=$_POST['remark'];
            $status=$_POST['status'];

        if($_SESSION['trans']=='new')
        {
                $query = "INSERT INTO `appointment`( `appfor`, `docid`, `patientname`, `emailid`, `appdate`, `apptime`, `remark`, `status`) VALUES ('$appfor','$docid','$patientname','$emailid','$appdate','$apptime','$remark','panding')";
                $result = $dc->insertrecord($query);
            
            if(!$result)
            {
                $msg="record not inserted";
            }
        }

        if($_SESSION['trans']=='update')
        {
                $query = "update appointment set appfor='$appfor',docid='$docid',patientname='$patientname',emailid='$emailid',appdate='$appdate',apptime='$apptime',remark='$remark',status='$status' where appid='$appid'";
                $result = $dc->updaterecord($query);
            
            if(!$result)
            {
                $msg="record not updated";
            }
        }
            


            if($result)
            {
                header('location:showdoctor.php');
            }
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
                    <h2 class="ps-4">Appointment Form</h2>
                    </div>
            <div class="col-md-6">


                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Appfor</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="appfor" value='<?php echo $appfor ?>' autofocus>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Docid</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="docid" value='<?php echo $docid?>'>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Patientname</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="patientname" value='<?php echo $patientname?>'>
                    </div>
                </div>
                
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Emailid</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="emailid" value='<?php echo $emailid?>'>
                    </div>
                </div>
       
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Appdate</label>
                    <div class="col-md-9">
                    <input type="date" class="form-control" name="appdate" value='<?php echo $appdate?>'>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Apptime</label>
                    <div class="col-md-9">
                    <input type="time" class="form-control" name="apptime" value='<?php echo $apptime?>'>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Remark</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="remark" value='<?php echo $remark?>'>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Status</label>
                    <div class="col-md-9">
                    <textarea placeholder="Write here" name="status" id="" cols="56" rows="5"><?php echo $status?></textarea>
                    </div>
                </div>
                
                <div class="row-md-3">
                   
                </div>

                </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center ">
                    <input type="submit" class="btn btn-success m-3" name="bsave" value='save' >
                    <input type="submit" class="btn btn-danger m-3" name="bcancel" value='cancel'>
                    </div>
                </div>
            </section>       
</main>
    </form>
   </div>
</body>
</html>