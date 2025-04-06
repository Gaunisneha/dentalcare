<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="css/login.css">
  <?php include("csslink.php"); ?>
  <?php 
    session_start();
    include ("../class/dataclass.php");
    $dc=new dataclass();
     ?>
</head>
<?php
// $conn=mysqli_connect("localhost","root","","dental_db");
    $email="";
    $password="";
    $query="";
    $docname="";
    $msg="";
?>

<?php

if(isset($_POST['btn']))
{
   $docname=$_POST['docname'];
   $password=$_POST['password']; 
  //  $emailid=$_POST['emailid'];

  if (empty($docname) || empty($password)) {
    $msg = "Please enter both username and password!";
    // header("Location: doctorlogin.php");
} else {
  $query = "SELECT * FROM dentist WHERE docname='$docname' AND password='$password' ";
   $result=$dc->getrow($query);
   if ($result) {
      $_SESSION['docid'] = $result['docid']; 
      $_SESSION['docname'] = $docname;
      header("Location: doctorhome.php");
      exit();
  } else {
      $msg = "Invalid username or password!";
  }
}
}
           
?>
<body>
    
    <div class="container">
    <form action="#" method="POST">
<div class="wrapper">
        <div class="logo">
            <!-- <img src="img/adminimg.jpeg" alt=""> -->
            <img src="../admin/img/admin2.jpg" alt="">
        </div>
        <div class="text-center mt-4 name">
            DENTIST LOGIN
        </div>

        <?php if (!empty($msg)) { ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $msg; ?>
                    </div>
                <?php } ?>

        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="docname" id="userName" placeholder="Docname">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <input class="btn mt-3" type="submit" name="btn" value="Login">
        </form>
        <div class="text-center fs-6">
            <a href="forgottpass.php">Forget password?</a> or <a href="doctorform.php">Register??</a>
        </div>
    </div>
    </form>
    </div>
</body>
</html>

