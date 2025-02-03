<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("csslink.php");
     include("../class/dataclass.php");
     ?>
     <?php
        $regid="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
        $count=0;
     ?>
     <?php    
        if(isset($_POST['bnew']))
        {
            $_SESSION['trans']='new';
            header('location:registrationform.php');
        
        }

    if(isset($_POST['bupdate']))
    {
        $regid=$_POST['bupdate'];
        $_SESSION['regid']=$regid;
        $_SESSION['trans']='update';
        header('location:registrationform.php');
    }
    if(isset($_POST['bdelete']))
    {
        $regid=$_POST['bdelete'];
        $query="delete from  registration where regid='$regid'";
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
                        <h2 class="text-center">Appointment Data</h2>
                    </div>
                    <div class="col-md-1">
                         <input type="text" placeholder="Search" id="myInput" class="form-control"  >
                    </div>
                  </div>
                  <div class="row">
                    <div class="12">
                        <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>appID</th><th>DATE</th><th>patientid</th><th>docid</th><th>time</th><th>remark</th><th>status</th><th>DELETE</th><th>UPDATE</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                    $query="select * from appointment  ";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['appid']."</td>");
                        echo("<td>".$rw['appdate']."</td>");
                        echo("<td>".$rw['patientid']."</td>");
                        echo("<td>".$rw['docid']."</td>");
                        echo("<td>".$rw['apptime']."</td>");
                        echo("<td>".$rw['remark']."</td>");
                        echo("<td>".$rw['status']."</td>");
                        echo("<td><button class='btn btn-danger' type='submit' name='bdelete' value=".$rw['appid'].">Delete Data</button></td>");
                        echo("<td><button class='btn btn-success' type='submit' name='bupdate' value=".$rw['appid'].">Update Data</button></td>");
                        echo("</tr>");
                        $count++;
                    }
                    ?>
                    </tbody>
                    </table>
                    <span>Total Appointmenta:<?php echo($count)?></span>
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