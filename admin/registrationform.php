<!DOCTYPE html>

<html lang="en">
<head>
 <?php 
     session_start();
     include("../class/dataclass.php");
     ?>
     <?php
        $regid="";
        $regdate="";
        $username="";
        $password="";
        $emailid="";
        $contactno="";
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
            $regname=$rw['regdate'];
            $username=$rw['username'];
            $password=$rw['password'];
            $emailid=$rw['emailid'];
            $contactno=$rw['contactno'];
        }

        
        
        if(isset($_POST['bsave']))
        {
            $regdate=$_POST['regdate'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $emailid=$_POST['emailid'];
            $contactno=$_POST['contactno'];
          

        if($_SESSION['trans']=='new')
        {
                $query = "INSERT INTO `registration`( `regdate`, `username`, `password`, `emailid`, `contactno`) 
                VALUES ('$regdate','$username','$password','$emailid','$contactno')";
                $result = $dc->insertrecord($query);
            
            if(!$result)
            {
                $msg="record not inserted";
            }
        }

        if($_SESSION['trans']=='update')
        {
                $query = "update registration set regdate='$regdate',username='$username',password='$password',emailid='$emailid',contactno='$contactno' where regid='$regid'";
                $result = $dc->updaterecord($query);
            
            if(!$result)
            {
                $msg="record not updated";
            }
        }
            


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
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
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


                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">regdate</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control" name="regdate" value='<?php echo $regdate ?>' autofocus>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">username</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="username" value='<?php echo $username?>'>
                    </div>
                </div>
                
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">password</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="password" value='<?php echo $password?>'>
                    </div>
                </div>
       
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Emailid</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="emailid" value='<?php echo $emailid?>'>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">contactno</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="contactno" value='<?php echo $contactno?>'>
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