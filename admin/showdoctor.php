<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("csslink.php");
     include("../class/dataclass.php");
     ?>
     <?php
        $docid="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
     ?>
     <?php    
        if(isset($_POST['bnew']))
        {
            $_SESSION['trans']='new';
            header('location:doctorform.php');
        
        }

    if(isset($_POST['bupdate']))
    {
        $docid=$_POST['bupdate'];
        $_SESSION['docid']=$docid;
        $_SESSION['trans']='update';
        header('location:doctorform.php');
    }
    if(isset($_POST['bdelete']))
    {
        $docid=$_POST['bdelete'];
        $query="delete from  dentist where docid='$docid'";
        $result=$dc->deleterecord($query);
        if($result)
        {
            $msg="Delete record Successfully...";
        }
        else{
            $msg="Record not deleted...";
        }
    }
    ?>
</head>
<body>
<?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
   <form action="#" method="POST">
        <main id="main" class="main">
            <section class="section dashboard">
                  <div class="row">
                    <div class="col-md-11">
                        <h2 class="text-center pt-2 ">Dentist details</h2>
                    </div>
                    <div class="col-md-1">
                         <input type="submit" class="btn btn-success" name="bnew" value="new">
                    </div>
                  </div>
                  <div class="row">
                    <div class="12">
                        <table class="table table-bordered">
                    <tr>
                        <th>DENTISTID</th><th>DENTISTNAME</th><th>CONTACTNO</th><th>EMAILID</th><th>QUALIFICATION</th><th>EXEPERIENCE</th><th>SPECIALIZATION</th><th>DELETE</th><th>UPDATE</th>
                    </tr>
                    <?php 
                    $query="select * from dentist  ";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['docid']."</td>");
                        echo("<td>".$rw['name']."</td>");
                        echo("<td>".$rw['contactno']."</td>");
                        echo("<td>".$rw['emailid']."</td>");
                        echo("<td>".$rw['qualification']."</td>");
                        echo("<td>".$rw['experience']."</td>");
                        echo("<td>".$rw['speciality']."</td>");
                        echo("<td><button class='btn btn-danger' type='submit' name='bdelete' value=".$rw['docid'].">Delete Data</button></td>");
                        echo("<td><button class='btn btn-success' type='submit' name='bupdate' value=".$rw['docid'].">Update Data</button></td>");
                        echo("</tr>");
                    }
                    ?>
                    
                    </table>
                    </div>
                  </div>
            </section>       
</main>
    </form>
   </div>
   <?php include("footer.php"); ?>
   <?php include("jslink.php"); ?>
   

</body>
</html>