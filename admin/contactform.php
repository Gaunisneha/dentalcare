<!DOCTYPE html>

<html lang="en">
<head>
 <?php 
     session_start();
     include("../class/dataclass.php");
     ?>
     <?php
        $contactid="";
        $contactdate="";
        $fullname="";
        $emailid="";
        $contactno="";
        $details="";
        $status="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
     ?>


     <?php    
        if($_SESSION['trans']=='update')
        {
            $contactid=$_SESSION['contactid'];
            $query="select * from contactus where contactid='$contactid'";
            $rw=$dc->getrow($query);
            $contactdate=$rw['contactdate'];
            $fullname=$rw['fullname'];
            $emailid=$rw['emailid'];
            $contactno=$rw['contactno'];
            $details=$rw['details'];
            $status=$rw['status'];
        }

        
        
        if(isset($_POST['bsave']))
        {
            $contactdate=$_POST['contactdate'];
            $fullname=$_POST['fullname'];
            $emailid=$_POST['emailid'];
            $contactno=$_POST['contactno'];
            $details=$_POST['details'];
            $status=$_POST['status'];
          

        if($_SESSION['trans']=='new')
        {
                $query = "INSERT INTO `contactus`( `contactdate`, `fullname`, `emailid`, `contactno`, `details`, `status`) 
                VALUES ('$contactdate','$fullname','$emailid','$contactno','$details','$status')";
                $result = $dc->insertrecord($query);
            
            if(!$result)
            {
                $msg="record not inserted";
            }
        }

        if($_SESSION['trans']=='update')
        {
                $query = "update contactus set contactdate='$contactdate',fullname='$fullname',emailid='$emailid',contactno='$contactno',details='$details',status='$status' where contactid='$contactid'";
                $result = $dc->updaterecord($query);
            
            if(!$result)
            {
                $msg="record not updated";
            }
        }
            


            if($result)
            {
                header('location:showcontact.php');
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
                    <h2 class="ps-4">Contact Form</h2>
                    </div>
            <div class="col-md-6">


                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">contactdate</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control" name="contactdate" value='<?php echo $contactdate ?>' autofocus>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Fullname</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="fullname" value='<?php echo $fullname?>'>
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
                    <label class="col-md-3 col-form-label">details</label>
                    <div class="col-md-9">
                   <textarea name="details" class="form-control" value='<?php echo $details?>'></textarea>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">status</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="status" value='<?php echo $status?>'>
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