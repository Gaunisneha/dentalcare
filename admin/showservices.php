<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("csslink.php");
     include("../class/dataclass.php");
     ?>
     <?php
        $serviceid="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
        $count=0;
     ?>
     

     <?php    
        if(isset($_POST['bnew']))
        {
            $_SESSION['trans']='new';
            header ('location:servicesform.php');
        
        }

        


    if(isset($_POST['bupdate']))
    {
        $serviceid=$_POST['bupdate'];
        $_SESSION['serviceid']=$serviceid;
        $_SESSION['trans']='update';
        header('location:servicesform.php');
    }
    if(isset($_POST['bdelete']))
    {
        $serviceid=$_POST['bdelete'];
        $query="delete from services where serviceid='$serviceid'";
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
                        <h2 class="text-center pt-2">Services Details</h2>
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
                        <th>SERVICEID</th>
                        <th>SERVICENAME</th>
                        <th>PRICE</th>
                        <!-- <th>DOC-ID</th> -->
                        <!-- <th>STATUS</th> -->
                        <th>OPRATION</th>
                        
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                    $query="select * from services";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['serviceid']."</td>");
                        echo("<td>".$rw['servicename']."</td>");
                        echo("<td>".$rw['price']."</td>");
                        // echo("<td>".$rw['docid']."</td>");
                        echo("<td><button class='btn btn btn-danger btn-sm me-2' type='submit' name='bdelete' value=".$rw['serviceid'].">
                         <i class='fas fa-trash-alt'></i></button>");
                        echo("<button class='btn btn-warning btn-sm' type='submit' name='bupdate' value=".$rw['serviceid'].">
                        <i class='fas fa-edit'></i></button></td>");
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