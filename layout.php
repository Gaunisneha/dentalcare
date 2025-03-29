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
        $emailid=$_POST['emailid'];
        $contactno=$_POST['contactno'];
        $query="INSERT INTO `registration`( `regdate`, `username`, `password`, `emailid`, `contactno`) VALUES ('$regdate','$username','$password','$emailid','$contactno')";
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
            die("error".mysqli_error($dc));
        }
     }

     ?>
     <?php 
     include("csslink.php") ?>
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
     $password=$_POST['password'];
     $emailid=$_POST['emailid'];
     $result=$dc->getrow($query);
  }
  ?>



<!-- edit profile code -->
<div class="content">
        <form action="#" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <main id="main" class="container">
                <section class="section dashboard">
                    <div class="row">
                        <div class="row m-5">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <h2 class="ps-4">Edit User Profile</h2>
                                <?php if ($msg) { echo "<p class='alert alert-danger'>$msg</p>"; } ?>
                                <p id="formError" class="error"></p>

                            </div>

                            <div class="col-md-6">
                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="username"  id="username" value='<?php echo $username ?>' autofocus>
                                        <span class="error" id="usernameError"></span>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Emailid</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="emailid"  id="emailid" value='<?php echo $emailid ?>'>
                                        <span class="error" id="emailError"></span>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Contactno</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="contactno" id="contactno" value='<?php echo $contactno ?>'>
                                        <span class="error" id="contactError"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Gender</label>
                                    <div class="col-md-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Address</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="address" id="address"><?php echo $address ?></textarea>
                                        <span class="error" id="addressError"></span>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <label class="col-md-3 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input name="image" type="file" class="form-control" id="image" value="<?php echo $filename ?>">
                                        <span class="error" id="imageError"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-success m-3" name="update" value='Save'>
                                <input type="submit" class="btn btn-danger m-3" name="cancel" value='Cancel'>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </form>