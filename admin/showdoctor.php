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
        $count=0;
     ?>
     <?php    
        if(isset($_POST['bnew']))
        {
            $_SESSION['trans']='new';
            header ('location:doctorform.php');
        
        }

        if(isset($_POST['aprove']))
        {
            $docid=$_POST['aprove'];
            
            $query = "update dentist set status='Active' where docid='$docid'";
            $result = $dc->updaterecord($query);
            
            
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
                  <div class="row mb-3">
                    <div class="col-md-10">
                        <h2 class="text-center pt-2">Dentist details</h2>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-11 p-3">
                         <input type="text" placeholder="Search" id="myInput" class="form-control"  >
                    </div>
                    <br>
                    <div class="col-md-1 p-3">
                         <input type="submit" class="btn btn-success" name="bnew" value="new">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table-dark">
                               
                    <tr>
                        <th>DENTISTID</th>
                        <th>DENTISTNAME</th>
                        <th>CONTACTNO</th>
                        <th>EMAILID</th>
                        <th>QUALIFICATION</th>
                        <th>EXEPERIENCE</th>
                        <th>SPECIALIZATION</th>
                        <th>STATUS</th>
                        <th>OPERATIONS</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                    $query="select * from dentist";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['docid']."</td>");
                        echo("<td>".$rw['docname']."</td>");
                        echo("<td>".$rw['contactno']."</td>");
                        echo("<td>".$rw['emailid']."</td>");
                        echo("<td>".$rw['qualification']."</td>");
                        echo("<td>".$rw['experience']."</td>");
                        echo("<td>".$rw['speciality']."</td>");
                        echo("<td>".$rw['status']."</td>");

                        
   
                        if('Pending'==$rw['status'])
                        {
                            echo("<td><button class='btn btn-success btn-sm' type='submit' name='aprove' value=".$rw['docid'].">Approve</button></td>");
                        }
                        else
                        {
                        echo("<td><button class='btn btn btn-danger btn-sm me-2' type='submit' name='bdelete' value=".$rw['docid'].">
                         <i class='fas fa-trash-alt'></i></button>");

                        echo("<button class='btn btn-warning btn-sm' type='submit' name='bupdate' value=".$rw['docid'].">
                        <i class='fas fa-edit'></i></button></td>");
                        }
                        echo("</tr>");
                        $count++;
                    }
                    ?>
                    </tbody>
                    </table>
                    <span>Total Appointments:<?php echo($count)?></span>
                    </div>
                  </div>
            </section>       
</main>
    </form>
    <?php include("footer.php"); ?>
   </div>
                    
   <?php include("jslink.php"); ?>
   

</body>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</html>