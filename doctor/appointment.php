<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 
  <?php 
    include ("../doctor/csslink.php");
    include("../class/dataclass.php");
    ?>
    <?php
      $dc=new dataclass();
      $msg="";
      
if(isset($_POST['aprove']))
        {
            $docid=$_POST['aprove'];
            $query = "update appointment set status='Active' where docid='$docid'";
            $result = $dc->updaterecord($query);  
        }
//         ?>
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
                        <h2 class="text-center pt-2 "> Appointment details</h2>
                    </div>
                    </div>
                    <div class="row">

                    <div class="col-md-12 p-3">
                         <input type="text" placeholder="Search" id="myInput" class="form-control"  >
                    </div>
                    <br>
               

                  </div>
                  <div class="row">
                    <div class="12">
                        <table class="table table-bordered">
                            <thead>
                            
                    <tr>
                        <th>PATIENT NAME</th><th>EMAILID</th><th>APPDATE</th><th>APPTIME</th><th>REMARK</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                   
                    $query="select * from appointment where docid=$docid";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['patientname']."</td>");
                        echo("<td>".$rw['emailid']."</td>");
                        echo("<td>".$rw['appdate']."</td>");
                        echo("<td>".$rw['apptime']."</td>");
                        echo("<td>".$rw['remark']."</td>");
                        echo("<td>".$rw['status']."</td>");
                        if('Pending'==$rw['status'])
                        {
                        echo("<td><button class='btn btn-success' type='submit' name='aprove' value=".$rw['docid'].">Aprove</button></td>");
                        }
                        else
                        {
                        echo("<td><button class='btn btn-success' type='submit' name='bdelete' value=".$rw['docid'].">Delete Data</button>");
                        echo("<button class='btn btn-danger ms-3' type='submit' name='bupdate' value=".$rw['docid'].">Update Data</button></td>");
                        }
                        
                    }
                    ?>
                    </tbody>
                    </table>
                    </div>
                  </div>
            </section>       
</main>
    </form>
    
   </div>
   <!--  -->
   <?php include("jslink.php"); ?> 
</body>
</html>