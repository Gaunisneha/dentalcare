<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    session_start();
    include ("../class/dataclass.php");
   
     ?> 
     <?php 
     $profileid="";
     $firstname="";
     $lastname="";
     $address1="";
     $address2="";
     $cityid="";
     $gender="";
     $birthdate="";
     $filename="";
     $tmpname="";
     $msg="";
     $query="";
     $dc=new dataclass();
     ?>
     <?php 
     if(isset($_POST['btn1'])) 
     {
        $profileid=$_SESSION['regid'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $address1=$_POST['address1'];
        $address2=$_POST['address2'];
        $cityid=$_POST['cityid'];
        $gender=$_POST['gender'];
        $birthdate=$_POST['birthdate'];
        $filename=$_FILES['image']['name'];
        $tmpname=$_FILES['image']['tmp_name'];
        $query="update profile set firstname='$firstname',lastname='$lastname',address1='$address1',address2='$address2',cityid='$cityid',gender='$gender',birthdate='$birthdate',image='$filename' where profileid='$profileid'";
        $result=$dc->updaterecord($query);
        if($result)
        {
            move_uploaded_file($tmpname,'profileimages/'.$filename);
             $msg="profile  successfull!!";
        }
        else
        {
            $msg="profile unsuccessfull!!";
        }
     }
     ?>
     <?php 
     include("csslink.php") 
     ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      padding: 40px;
    }
    .form-container {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }
    .form-label {
      font-weight: bold;
    }
    .form-control {
      border-radius: 8px;
    }
    .btn-submit {
      border-radius: 8px;
    }
    .form-row {
      margin-bottom: 1rem;
    }
    .heading
    {
      font-weight: 700;
    }
  </style>
</head>

<body>
  <div class="container form-container">
    <h3 class="mb-4 text-center  heading">Profile</h3>
    <form method="POST" action="#" enctype="multipart/form-data">
      <div class="row mb-2">
        <label for="fullname"  class="col-sm-2 col-form-label form-label">First Name</label>
        <div class="col-sm-10">
          <input type="text"  class="form-control" id="firstname" placeholder="Enter Full Name" name="firstname" value="<?php echo ($firstname)?>"autofocus>
        </div>
      </div>

      <div class="row mb-2">
        <label for="fullname"  class="col-sm-2 col-form-label form-label">Last Name</label>
        <div class="col-sm-10">
          <input type="text"  class="form-control" id="lastname" placeholder="Enter Full Name" name="lastname" value="<?php echo ($lastname)?>">
        </div>
      </div>

      <div class="row mb-2">
        <label for="address" class="col-sm-2 col-form-label form-label">Address1</label>
        <div class="col-sm-10">
          <textarea class="form-control"  id="address1" rows="3" placeholder="Enter Address"  name="address1" value="<?php echo ($address1)?>" ></textarea>
        </div>
      </div>

      <div class="row mb-2">
        <label for="address" class="col-sm-2 col-form-label form-label">Address2</label>
        <div class="col-sm-10">
          <textarea class="form-control"  id="address2" rows="3" placeholder="Enter Address"  name="address2" value="<?php echo ($address2)?>" ></textarea>
        </div>
      </div>

      <div class="row mb-2">
        <label for="cityid">CityId</label>
        <select name="cityid" class="form-control">
        <option selected>Select city</option>
                                        <?php
                                        $query1="select cityid,cityname from city ";
                                        $tb=$dc->gettable($query1);
                                        while($rw=mysqli_fetch_array($tb))
                                        {
                                            if($cityid==$rw['cityid'])
                                            {
                                                echo"<option value=".$rw['cityid'].">".$rw['cityname']."</option>";
                                            }
                                            else
                                            {
                                                echo"<option value=".$rw['cityid'].">".$rw['cityname']."</option>";
                                            }
                                        }
                                        ?>
        </select>
      </div> 

      <div class="row mb-2">
        <label for="gender" class="col-sm-2 col-form-label form-label">Gender</label>
        <div class="col-sm-10">
          <select name="gender" class="form-select" id="gender">
            <option selected>Choose Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
      </div>

      <div class="row mb-2">
        <label for="birthdate" class="col-sm-2 col-form-label form-label">Birthdate</label>
        <div class="col-sm-10">
          <input  type="date" class="form-control" id="birthdate"  name="birthdate" value="<?php echo ($birthdate)?>" >
        </div>
      </div>

      <div class="row mb-2">
        <label for="image" class="col-sm-2 col-form-label form-label">Profile Image</label>
        <div class="col-sm-10">
          <input name="image" type="file" class="form-control" class="image">
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
          <input type="submit" name="btn1" class=" form-control btn btn-primary p-2 mt-3 btn-submit" value="Submit">
        </div>
      </div>
    </form>
    <?php echo $msg?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
