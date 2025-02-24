<!doctype html>
<html lang="en">
  <head>
    <?php 
    session_start();
    include ("../class/dataclass.php");

     ?>
     <?php 
     $regdate="";
     $username="";
     $password="";
     $emailid="";
     $contactno="";
     $query="";
     $msg="";
     $dc=new dataclass();
     ?>
     <?php 
     if(isset($_POST['btn1'])) 
     {
        $regdate=date('y-m-d');
        $username=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $emailid=$_POST['emailid'];
        $contactno=$_POST['contactno'];
        // if (empty($username) ||  empty($password) || empty($emailid) || empty($contactno)) {
        //     echo '<script>
        //             alert("Please fill out all required fields.");
        //              window.location="loginpage.php";
        //           </script>';
        //     exit();
        // }
        //     elseif (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/", $password)) {
        //         echo '<script>
        //             alert("Password is invalid. It must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character");
        //              window.location="loginpage.php";
        //           </script>';
        //     exit();
            
        // } elseif (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
        //     echo '<script>
        //             alert("Invalid email format.");
        //              window.location="loginpage.php";
        //           </script>';
        //     exit();
        // } elseif (!preg_match("/^[0-9]{10}$/", $contactno)) {
        //     echo '<script>
        //             alert("Invalid contact number. It should be 10 digits.");
        //              window.location="loginpage.php";
        //           </script>';
        //     exit();
        // }
        
        // if($cpassword!=$password){
        //     '<script>
        //     echo "password does not match!!!";
        //     window.location="loginpage.php";
        //     </script>';
        // }
        // else{
        
        $query="INSERT INTO `registration`( `regdate`, `username`, `password`, `emailid`, `contactno`) VALUES (NOW(),'$username','$password','$emailid','$contactno')";
        $result=$dc->insertrecord($query);
        if($result)
        {
            // $_SESION['username']=$username;
            // header('location:')
             $msg="registration successfull!!";
        }
        else
        {
            $msg="registration unsuccessfull!!";
            die("error".mysqli_error($dc->conn));
        }
     }
    // }
     ?>
     <?php include("csslink.php") ?>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>responsive login page</title>
  </head>
  <?php 
     $regdate="";
     $password="";
     $emailid="";
     $query="";
     $msg="";
     $dc=new dataclass();
  ?>

  <?php
  if(isset($_POST['btn']))
  {
     $username=$_POST['username'];
     $password=$_POST['password'];
    //  $emailid=$_POST['emailid'];
    $query = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
     $result=$dc->getrow($query);
     if ($result) {
        $_SESSION['username'] = $username;
        header("Location: mainhome.php");
        exit();
    } else {
        $msg = "Invalid username or password!";
    }
  }
  ?>
  <body>
    <div class="container">
        <div class="form-box login">
            <form action="" method="POST">
                <h1>Sign In</h1>
                <div class="input-box">
                    <input type="text" name="username" id="username" placeholder="Username">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <!-- <div class="forgot-password">
                    <a href="#" onclick="forgotPassword()">Forgot Password?</a>
                </div> -->
                <div class="forgot-link">
                    <a href="#" onclick="forgotPassword()" >Forgot Password?</a>
                </div>
                <input type="submit" value="Sign In" class="btn" name="btn">
                <!-- <p>or sign in with social platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook' ></i></a>
                    <a href="#"><i class='bx bxl-instagram' ></i></a>
                    <a href="#"><i class='bx bxl-linkedin' ></i></a>

                </div> -->
            </form>
        </div>
        <div class="form-box register">
            <form action="#" method="POST">
                <h1>Sign Up</h1>
                <div class="input-box">
                    <input type="text" name="username" id="username" placeholder="Username"  onchange="onlyalpha(this,lusername)" onkeyup="onlyalpha(this,lusername)">
                    <span class="errmsg" id="lusername"></span>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="emailid" id="emailid" placeholder="Email" onchange="validateEmail(this,lemail)" onkeyup="validateEmail(this,lemail)">
                    <span class="errmsg" id="lemail"></span>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="contactno" id="contactno" placeholder="Contact" onchange="validateContactNo(this,lcontact)" onkeyup="validateContactNo(this,lcontact)">
                    <span class="errmsg" id="lcontact"></span>
                    <i class='bx bxs-phone'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password" onchange="checklength(this,lpassword,6,10)" onkeyup="checklength(this,lpassword,6,10)" >
                    <span class="errmsg" id="lpassword"></span>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm-Password">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <input type="submit" name="btn1" value="Sign Up" class="btn"></input>
            </form>
        </div>
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <?php $_SESSION['username']=$username; ?>
                <h2 class="pt-3"><?php echo $username;?></h2> 
                <h1>Welcome to<br> Dental Care!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Sign Up</button>
                <h3><?php echo $msg ?></h3>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Sign In</button>
            </div>
        </div>
    </div>
    
    <script src="js/login.js"></script>
    <script src="../validation.js"></script>
    
  </body>
</html>