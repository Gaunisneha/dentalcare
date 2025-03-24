<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php 
session_start(); // Ensure session is started at the beginning of the file
try {
    include ("../class/dataclass.php");
    $dc = new dataclass();
    
    
    if (isset($_SESSION['regid'])) {
        $regid = $_SESSION['regid'];
    } else {
        header("Location: loginpage.php"); 
        exit();
    }
    
    ?>
  <style>
    body{
    background: -webkit-linear-gradient(left, #06A3DA, #06A3DA);
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
    
}
.profile-img img{
    width: 70%;
    height: 100%;
    border-radius: 50%;

}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0d6efd;;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
  </style>
</head>
<?php 
    $redate = "";
    $username = "";
    $contactno = "";
    $emailid = "";
    $password = "";
    $image = "";
    $gender="";
    $address="";
    
    $query = "SELECT * FROM registration WHERE regid=$regid"; 
    $tb = $dc->gettable($query);

    while ($rw = mysqli_fetch_array($tb)) {
        $regid = $rw['regid'];
        $redate = $rw['regdate'];
        $username = $rw['username'];
        $contactno = $rw['contactno'];
        $emailid = $rw['emailid'];
        $gender = $rw['gender'];
        $address = $rw['address'];
        $image = $rw['image'];
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<body>
  
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
 
<div class="container emp-profile">
    <h1 class="p-4">PROFILE:</h1>
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="../home/profileimages/<?php echo $image;?>" alt=""/>
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                    <?php echo $username; ?>
                                    </h5>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                    <a href="../home/profile.php"><input type="button" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                   
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $regid; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $username; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $emailid; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $contactno; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Gender</label>
                                            </div>
                                            <div class="col-md-6">
                                            <p><?php echo $gender; ?></p>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                            <p><?php echo $address; ?></p>

                                            </div> 
                                        </div>
                                        <div class="row">
                                        <div class="col-md-4">
                                        <a href="../home/changepass.php"><input type="button"   class="profile-edit-btn" name="btnAddMore" value="Change Password"/></a>
                                        </div> 
                                            <div class="col-md-4">
                                            <a href="../home/mainhome.php"><input type="button"   class="profile-edit-btn" name="btnAddMore" value="Exit"/></a>
                                            </div> 
                                            <div class="col-md-4">
                                          </div>
                                        </div>
                                      
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
        </body>
</html>