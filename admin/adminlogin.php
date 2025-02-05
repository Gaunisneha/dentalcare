<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style1.css">
  <?php include("csslink.php"); ?>
</head>
<?php

$conn=mysqli_connect("localhost","root","","dental_db");
    $email="";
    $password="";
    $usertype="";
    $query="";
?>

<?php

        if(isset($_POST['submit']))
        {
            $username=$_POST['username'];
            $password=$_POST['password'];
           
            if($username="gaunisneha" && $password="9100")
            {
                   header('location:adminhome.php');

                   echo "
                    '<script>
    
                            const v=document.getElementById('login');
                            v.style.visibility='hidden';

                    </script>'
                    
                   ";
                    
                }
                else
                {
                    echo"<script>alert('Invalid Email');</script>";
                }
            }
           
?>
<body>
    <div class="container">
    <form action="#" method="POST">
<div class="wrapper">
        <div class="logo">
            <img src="../images/adminimg.jpeg" alt="">
        </div>
        <div class="text-center mt-4 name">
            ADMIN LOGIN
        </div>
        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="userName" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <input class="btn mt-3" type="submit" name="submit" value="Login">
        </form>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="#">Sign up</a>
        </div>
    </div>
    </form>
    </div>
</body>
</html>