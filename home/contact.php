<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    
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
        $query="INSERT INTO `contactus`(`contactdate`, `fullname`, `emailid`, `contactno`, `details`, `status`) VALUES ('$contactdate','$fullname','$emailid','$contactno','$details','pending')";
        $result=$dc->insertrecord($query);
        if($result)
        {
            
             $msg="Contact successfull!!";
        }
        else
        {
            $msg="registration unsuccessfull!!";
            
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
                        <label class="form-lable" ><?php echo $msg ?></label>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=ssagrawal%20navsari+(Dental%20Health%20Care)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/collections/drones/">drones ireland</a></iframe></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <?php   include("footer.php") ?> 
</body>
<?php include("jsslink.php") ?>
</html>