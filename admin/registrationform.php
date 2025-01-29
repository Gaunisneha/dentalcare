<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("../class/dataclass.php");
     ?>
     <?php
        $regid="";
        $date="";
        $username="";
        $contactno="";
        $emailid="";
        $password="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
     ?>
     <?php    
        if($_SESSION['trans']=='update')
        {
            $regid=$_SESSION['regid'];
            $query="select * from registration where regid='$regid'";
            $rw=$dc->getrow($query);
            $date=$rw['regdate'];
            $username=$rw['username'];
            $contactno=$rw['contactno'];
            $emailid=$rw['emailid'];
            $password=$rw['password'];
        }

        if(isset($_POST['bsave']))
        {
            $date=$_POST['regdate'];
            $username=$_POST['username'];
            $contactno=$_POST['contactno'];
            $emailid=$_POST['emailid'];
            $password=$_POST['password'];
            $query = "INSERT INTO `registration`( `regdate`,`username`, `contactno`, `emailid`, `password`) 
            VALUES ('$date','$username','$contactno','$emailid','$password')";
            $result = $dc->insertrecord($query);
            echo "<script>console.log($result)</script>";


            if($result)
            {
                header('location:showregistration.php');
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
                    <h2 class="ps-4">Registration Form</h2>
                    </div>
            <div class="col-md-6">
            <!-- <div class="row-md-3 visibility-hidden" >
                    <label class="col-md-3 col-form-label">Date</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="regdate" value='<?php echo $date ?>'>
                    </div>
                </div> -->

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Username</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="username" value='<?php echo $username ?>' autofocus>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Contactno</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="contactno" value='<?php echo $contactno?>'>
                    </div>
                </div>
                
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Emailid</label>
                    <div class="col-md-9">
                    <input type="email" class="form-control" name="emailid" value='<?php echo $emailid?>'>
                    </div>
                </div>
       
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Password</label>
                    <div class="col-md-9">
                    <input type="password" class="form-control" name="password" value='<?php echo $password?>'>
                    </div>
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