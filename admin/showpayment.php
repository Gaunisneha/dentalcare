<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("csslink.php");
     include("../class/dataclass.php");
     ?>
     <?php
        $payid="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
        $count=0;
     ?>
     <?php    
        // if(isset($_POST['bnew']))
        // {
        //     $_SESSION['trans']='new';
        //     header ('location:doctorform.php');
        
        // }

        // if(isset($_POST['aprove']))
        // {
        //     $docid=$_POST['aprove'];
            
        //     $query = "update dentist set status='Active' where docid='$docid'";
        //     $result = $dc->updaterecord($query);
            
            
        // }


    // if(isset($_POST['bupdate']))
    // {
    //     $regid=$_POST['bupdate'];
    //     $_SESSION['docid']=$docid;
    //     $_SESSION['trans']='update';
    //     header('location:doctorform.php');
    // }
    // if(isset($_POST['bdelete']))
    // {
    //     $docid=$_POST['bdelete'];
    //     $query="delete from  dentist where docid='$docid'";
    //     $result=$dc->deleterecord($query);
    //     if($result)
    //     {
    //         $msg="Delete record Successfully...";
    //     }
    //     else{
    //         $msg="Record not deleted...";
    //     }
    // }
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
                        <h2 class="text-center pt-2">Payment Details</h2>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12 p-3">
                         <input type="text" placeholder="Search" id="myInput" class="form-control"  >
                    </div>
                    <br>
                    <!-- <div class="col-md-1 p-3">
                         <input type="submit" class="btn btn-success" name="bnew" value="new">
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table-dark">
                               
                    <tr>
                        <th>PAY-ID</th>
                        <th>DATE</th>
                        <th>PAY MODE</th>
                        <th>AMOUNT</th>
                        
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                    $query="select * from Payment";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['payid']."</td>");
                        echo("<td>".$rw['paydate']."</td>");
                        echo("<td>".$rw['paytype']."</td>");
                        echo("<td>".$rw['amount']."</td>");

    
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