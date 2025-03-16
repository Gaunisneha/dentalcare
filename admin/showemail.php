<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Email</title>
  <?PHP 
  include("csslink.php");
  session_start();
  include('../class/dataclass.php');
  $dc=new dataclass();
  $msg="";
  ?>
  <?php
  if(isset($_POST['email']))
  {
    $_SESSION['userid']=$_POST['email'];
    header('location:sendemail/emailform.php');
  } ?>
</head>
<body>
<?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
  <form action="#" method="POST">
    <!-- <div class="container"> -->
      <div class="row">
        <div class="col-md-12">
          <?php
          echo("<table class='table table-bordered'>");
          echo("<thead><tr>");
          echo("<th>Appid</th><th>AppDate</th><th>patientname</th><th>Email Address</th><th>Status</th><th>OPTION</th>");
               $query="select appid,appdate,patientname,emailid,status from appointment where status='active'";
               $tb=$dc->gettable($query);
               echo("<tbody>");
               while($rw=mysqli_fetch_array($tb))
               {
                   echo("<tr>");
                   echo("<td>".$rw['appid']."</td>");
                   echo("<td>".$rw['appdate']."</td>");
                   echo("<td>".$rw['patientname']."</td>");
                   echo("<td>".$rw['emailid']."</td>");
                   echo("<td>".$rw['status']."</td>");
                   echo("<td><button class='btn btn-danger m-2' type='submit' name='email' value=".$rw['appid'].">Email</button>");
                   echo("<button class='btn btn-primary' type='submit' name='email' value=".$rw['appid'].">Delete</button></td>");
                   echo("</tr>");
               
               }
               echo("</table>");
          ?>
        </div>
      </div>
      </div>
    </div>

  </form>
  <?php include("jslink.php"); ?>
</body>
</html>