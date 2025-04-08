<!DOCTYPE html>

<html lang="en">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
 <?php 
     session_start();
     include("../class/dataclass.php");
     ?>
     <?php
        $docid="";
        $docname="";
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
            $docname=$rw['docname'];
            $contactno=$rw['contactno'];
            $emailid=$rw['emailid'];
            $qualification=$rw['qualification'];
            $experience=$rw['experience'];
            $speciality=$rw['speciality'];
            $aboutus=$rw['aboutus'];
        }

        if(isset($_POST['bsave']))
        {
            $docname=$_POST['docname'];
            $contactno=$_POST['contactno'];
            $emailid=$_POST['emailid'];
            $qualification=$_POST['qualification'];
            $experience=$_POST['experience'];
            $speciality=$_POST['speciality'];
            $aboutus=$_POST['aboutus'];
            

        if($_SESSION['trans']=='new')
        {
                $query = "INSERT INTO `dentist`( `docname`, `contactno`, `emailid`, `qualification`, `experience`, `speciality`, `aboutus`,`status`) 
                VALUES ('$docname','$contactno','$emailid','$qualification','$experience','$speciality','$aboutus','Pending')";
                $result = $dc->insertrecord($query);
            
            if(!$result)
            {
                $msg="record not inserted";
            }
        }

        if($_SESSION['trans']=='update')
        {
                $query = "update dentist set docname='$docname',contactno='$contactno',emailid='$emailid',qualification='$qualification',experience='$experience',speciality='$speciality',aboutus='$aboutus' where docid='$docid'";
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
    <?php    
        if(isset($_POST['bcancel']))
        {
            $_SESSION['trans']='cancel';
            header ('location:showdoctor.php');
        
        }

       
?>
   
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control{
            border:1px solid black;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("btnsave").addEventListener("click", function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save/update this record?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Save it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a hidden input to simulate form submission for bsave
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "bsave";
                document.querySelector("form").appendChild(input);
                document.querySelector("form").submit();
            }
        });
    });

    document.getElementById("btncancel").addEventListener("click", function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will cancel the update process.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel',
            cancelButtonText: 'Keep Editing'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a hidden input to simulate form submission for bcancel
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "bcancel";
                document.querySelector("form").appendChild(input);
                document.querySelector("form").submit();
            }
        });
    });
</script>

<body>
<div class="container">
        <h2>Dentist Form</h2>
        <form action="#" method="POST">
            <div class="mb-3">
                <label class="form-label">Docname</label>
                <input type="text" class="form-control" name="docname" value='<?php echo $docname ?>' autofocus>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Contact No</label>
                <input type="text" class="form-control" name="contactno" value='<?php echo $contactno ?>'>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email ID</label>
                <input type="text" class="form-control" name="emailid" value='<?php echo $emailid ?>'>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Qualification</label>
                <input type="text" class="form-control" name="qualification" value='<?php echo $qualification ?>'>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Experience</label>
                <input type="text" class="form-control" name="experience" value='<?php echo $experience ?>'>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Speciality</label>
                <input type="text" class="form-control" name="speciality" value='<?php echo $speciality ?>'>
            </div>
            
            <div class="mb-3">
                <label class="form-label">About Us</label>
                <textarea class="form-control" name="aboutus" rows="4"><?php echo $aboutus ?></textarea>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success"  id="btnsave" name="bsave">Save</button>
                <button type="submit" class="btn btn-danger" id="btncancel" name="bcancel">Cancel</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

 


   <!-- <div class="content">

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
                    <label class="col-md-3 col-form-label">Speciality</label>
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
   </div> -->
</body>
</html>