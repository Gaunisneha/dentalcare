<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="css/login.css" rel="stylesheet">
  <?php include("csslink.php"); ?>

</head>
<?php

session_start();
include("../class/dataclass.php");
    $adminname="";
    $password="";
    $usertype="";
    $dc= new dataclass();
    $query="";
    $msg ="";
?>

<?php

if(isset($_POST['btn']))
{
   $adminname=$_POST['adminname'];
   $password=$_POST['password']; 
  //  $emailid=$_POST['emailid'];
  if (empty($adminname) || empty($password)) {
    $msg = "Please enter both username and password!";
} else {
  $query = "SELECT * FROM admin WHERE adminname='$adminname' AND password='$password' ";
   $result=$dc->getrow($query);
   if ($result) {
      $_SESSION['adminid'] = $result['adminid']; 
      $_SESSION['adminname'] = $adminname;
      header("Location: adminhome.php");
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
            <img src="../admin/img/admin2.jpg" alt="">
        </div>
        <div class="text-center mt-4 name">
            ADMIN LOGIN
        </div>
        <?php if (!empty($msg)) { ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $msg; ?>
                    </div>
                <?php } ?>
        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="adminname" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <input class="btn mt-3" type="submit" name="btn" value="Login">
        </form>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> 
        </div>
       <div class="text-center fs-6">
       <span class='p-3'> <?php echo $msg ?></span>
        </div>
    </div>
    
    </form>
    </div>
</body>
</html>