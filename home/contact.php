<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><?php 
    session_start();
    include ("../class/dataclass.php");
   
     ?>
     <?php 
     $contactdate="";
     $fullname="";
     $emailid="";
     $contactno="";
     $details="";
     $query="";
     $msg="";
     $dc=new dataclass();
     ?>
     <?php 
     if(isset($_POST['btn1'])) 
     {
        $contactdate=date('y-m-d');
        $fullname=$_POST['fullname'];
        $emailid=$_POST['emailid'];
        $contactno=$_POST['contactno'];
        $details=$_POST['details'];
        $query="INSERT INTO `contactus`(`contactid`, `contactdate`, `fullname`, `emailid`, `contactno`, `details`, `status`) VALUES ('$contactdate','$fullname','$emailid','$contactno','$details','pending')";
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
            // die("error".mysqli_error($dc));
        }
     }

     ?>
    
    <?php   include("csslink.php") ?>
</head>
<body>
<?php   include("topbar.php") ?> 
<?php   include("header.php") ?>
      <!-- Contact Start -->
      <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded h-100 p-5">
                        <div class="section-title">
                            <h5 class="position-relative d-inline-block text-primary text-uppercase">Contact Us</h5>
                            <h1 class="display-6 mb-4">Feel Free To Contact Us</h1>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Our Office</h5>
                                <span>S.S.Agarwal</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Email Us</h5>
                                <span>dentalcare1@gmail.com</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Call Us</h5>
                                <span>+91 8754875692</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <form method="POST" action="#">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="Your Name" name="fullname" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" name="emailid" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="Contact No" name="contactno" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0 bg-light px-4 py-3" rows="5" name="details" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <input class="btn btn-primary w-100 py-3" name="btn1" type="submit" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <?php   include("footer.php") ?> 
</body>
<?php include("jsslink.php") ?>
</html>