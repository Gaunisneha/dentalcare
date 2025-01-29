<!DOCTYPE html>

<html lang="en">
<head>
 <?php 
     session_start();
     include("../class/dataclass.php");
     ?>
     <?php
        $docid="";
        $name="";
        $contactno="";
        $emailid="";
        $qualification="";
        $experience="";
        $speciality="";
        $aboutus="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
     ?>

     <?php    
        if($_SESSION['trans']=='update')
        {
            $docid=$_SESSION['docid'];
            $query="select * from dentist where docid='$docid'";
            $rw=$dc->getrow($query);
            $name=$rw['name'];
            $contactno=$rw['contactno'];
            $emailid=$rw['emailid'];
            $qualification=$rw['qualification'];
            $experience=$rw['experience'];
            $speciality=$rw['speciality'];
            $aboutus=$rw['aboutus'];
        }

        if(isset($_POST['bsave']))
        {
            $name=$_POST['name'];
            $contactno=$_POST['contactno'];
            $emailid=$_POST['emailid'];
            $qualification=$_POST['qualification'];
            $experience=$_POST['experience'];
            $speciality=$_POST['speciality'];
            $aboutus=$_POST['aboutus'];

        if($_SESSION['trans']=='new')
        {
                $query = "INSERT INTO `dentist`( `name`, `contactno`, `emailid`, `qualification`, `experience`, `speciality`, `aboutus`) 
                VALUES ('$name','$contactno','$emailid','$qualification','$experience','$speciality','$aboutus')";
                $result = $dc->insertrecord($query);
            
            if(!$result)
            {
                $msg="record not inserted";
            }
        }

        if($_SESSION['trans']=='update')
        {
                $query = "update dentist set name='$name',contactno='$contactno',emailid='$emailid',qualification='$qualification',experience='$experience',speciality='$speciality',aboutus='$aboutus' where docid='$docid'";
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
                    <h2 class="ps-4">Dentist Form</h2>
                    </div>
            <div class="col-md-6">


                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Docname</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="name" value='<?php echo $name ?>' autofocus>
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
                    <input type="text" class="form-control" name="emailid" value='<?php echo $emailid?>'>
                    </div>
                </div>
       
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Qualification</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="qualification" value='<?php echo $qualification?>'>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Experience</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="experience" value='<?php echo $experience?>'>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">speciality</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="speciality" value='<?php echo $speciality?>'>
                    </div>
                </div>

                <div class="row-md-3">
                    <label class="col-md-3 col-form-label">Aboutus</label>
                    <div class="col-md-9">
                    <textarea placeholder="Write here" name="aboutus" id="" cols="56" rows="5"><?php echo $aboutus?></textarea>
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