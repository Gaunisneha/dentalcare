<!DOCTYPE html>
<html lang="en">
<head>
<?php 
session_start();
    include ("../class/dataclass.php");
     ?>
     <?php 
  
     $ouroffice="";
     $emailid="";
     $contactno="";
     $query="";
     $msg="";
     $dc=new dataclass();
     ?>
    
     <?php 
     if(isset($_POST['btn1'])) 
     {
        
        $ouroffice=$_POST['ouroffice'];
        $emailid=$_POST['emailid'];
        $contactno=$_POST['contactno'];
        $query="INSERT INTO `contactinfo`(`ouroffice`, `emailid`, `contactno`) VALUES ('$ouroffice','$emailid','$contactno')";
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

<?php   include("header.php") ?>
      <!-- Contact Start -->
      <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
        
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <form method="POST" action="#">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="OurOffice" name="ouroffice" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" name="emailid" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="Contact No" name="contactno" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input class="btn btn-primary w-100 py-3" name="btn1" type="submit" value="Edit">
                            </div>
                        </div>
                        <label class="form-lable" ><?php echo $msg ?></label>
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
 
</body>

</html>