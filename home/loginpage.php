<!doctype html>
<html lang="en">
  <head>
    <?php 
    session_start();
    include ("../class/dataclass.php");
   
     ?>
     <?php 
     $regid="";
     $regdate="";
     $username="";
     $password="";
     $emailid="";
     $contactno="";
     $query="";
     $query2="";
     $msg="";
     $dc=new dataclass();
     ?>
     <?php 
     if(isset($_POST['btn1'])) 
     {
        $regdate=date('Y-m-d');
        $username=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $emailid=$_POST['emailid'];
        $contactno=$_POST['contactno'];
        $filename=$_FILES['image']['name'];
        $tmpname=$_FILES['image']['tmp_name'];
        // $regid = $dc->primarykey("SELECT IFNULL(MAX(regid),0) + 1 FROM registration");
        $query="INSERT INTO `registration`( `regid`,`regdate`, `username`, `password`, `emailid`, `contactno`,`image`) VALUES ('$regid','$regdate','$username','$password','$emailid','$contactno','$filename')";
        $result=$dc->insertrecord($query);
        if($result)
        {
     
            if (!is_dir('profileimages')) {
                mkdir('profileimages', 0777, true);
            }
            move_uploaded_file($tmpname,'profileimages/'.$filename);
             $msg="registration successfull!!";
             $query2="insert into profile(profileid) values('$regid')";
             $result=$dc->insertrecord($query2);
        }
        else
        {
            $msg="registration unsuccessfull!!";
            
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
        $_SESSION['regid'] = $result['regid']; 
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
            <form action="" method="POST" onsubmit="return validateLoginForm()">
                <h1>Sign In</h1>
                <div class="input-box">
        <input type="text" name="username" id="username" placeholder="Username">
        <span id="loginUsernameError" class="error"></span>
        <i class='bx bxs-user'></i>
    </div>
    <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Password">
        <span id="loginPasswordError" class="error"></span>
        <i class='bx bxs-lock-alt'></i>
    </div>
                <div class="forgot-link">
                    <a href="forgotpass.php">Forgot Password?</a>
                </div>
                <input type="submit" value="Sign In" class="btn" name="btn">
            </form>
        </div>
        <div class="form-box register">
            <form action="#" method="POST" enctype="multipart/form-data" >
                <h1>Sign Up</h1>
                <div class="input-box">
                    <input type="text" name="username" id="username" placeholder="Username"  onchange="onlyalpha(this,lusername)" onkeyup="onlyalpha(this,lusername)">
                    <span id="lusername" class="error" id="usernameError"></span>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="emailid" id="emailid" placeholder="Email" onchange="validateEmail(this,lemail)" onkeyup="validateEmail(this,lemail)">
                    <span id="lemail" class="error" id="emailError" ></span>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="contactno" id="contactno" placeholder="Contact" onchange="validateContactNo(this,lcontact)" onkeyup="validateContactNo(this,lcontact)">
                    <span id="lcontact" class="error"></span>
                    <i class='bx bxs-phone'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="signup-password" placeholder="Password" onkeyup="validatePassword(this, document.getElementById('lpassword'))">
                     <!-- onkeyup="validatePassword(this,lpassword)" > -->
                    <span id="lpassword" class="error" ></span>
                </div>
                <div class="input-box">
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm-Password"  onkeyup="validateConfirmPassword()">
                    <span id="lcpassword" class="error" ></span>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="file" name="image" id="image" placeholder="image">
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
    <script src="../validation.js" defer></script> 
  </body>
</html>