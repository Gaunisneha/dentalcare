
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <?php 
  session_start();
   include('../../class/dataclass.php');
   $dc=new dataclass();
   $appid="";
   $patientname="";
   $emailid="";
   $msg="";
   
   if(isset($_SESSION['userid']))
   {
    $userid=$_SESSION['userid'];
    $query="select appid,patientname,emailid from appointment where appid='$userid'";
    $rw=$dc->getrow($query);
    if($rw)
    {
        $appid=$rw['appid'];
        $patientname=$rw['patientname'];
        $emailid=$rw['emailid'];
    }
   }
   

if(isset($_SESSION['userid']))
   {
    $userid=$_SESSION['userid'];
    $query="select contactid,fullname,emailid from contactus where contactid='$userid'";
    $rw=$dc->getrow($query);
    if($rw)
    {
        $contactid=$rw['contactid'];
        $patientname=$rw['fullname'];
        $emailid=$rw['emailid'];
    }
   }
   ?>
   <?php
     
      $msg="";
      if(isset($_SESSION ['msg']))
      {
        $msg=$_SESSION['msg'];
      }
        
    ?>
</head>
<body>
<form action="../sendemail/emailsend.php" method="post">
<div class="container">
<div class="row">
		      <div class="col-md-3"></div>
           <div class="col-md-6"> 
		    		
        <div class="form-group">
           <h2>Send Email</h2>
        </div>
  
    <div class="form-group">
        <label>Name</label>
        <input type="text"class="form-control" value="<?php echo $patientname;?>" name="username" required>
    </div>

    <div class="form-group">
        <label>Email Address</label><br>
        <input class="form-control" type="email" value="<?php echo $emailid; ?>" name="emailto" required>
        </div>
        <div class="form-group">
        <label>Subject </label><br>
        <input class="form-control" type="text"  name="subject" required>
        </div>
        <div class="form-group">
        <label>Message </label><br>
        <textarea class="form-control" name="message" rows="4" required></textarea>
        </div>
        <div class="form-group">
        <input class="btn btn-success" type="submit" value="Send">
        </div>
        <div class="form-group">
     <?php echo $msg ?> 
        </div>
    </div>
    </div>     
    </form>
</body>
</html>
