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
        $query="INSERT INTO `contactus`(`contactdate`, `fullname`, `emailid`, `contactno`, `details`, `status`) VALUES ('$contactdate','$fullname','$emailid','$contactno','$details','Pending')";
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
      <!-- Spinner Start -->
      <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
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
                                <span>subhankadawala8@gmail.com</span>
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
                    <form method="POST" action="#" id="contactForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="Your Name" id="fullname" name="fullname" style="height: 55px;">
                                <span id="fullnameError" style="color: red; font-size: 12px;"></span>
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" name="emailid" id="emailid" style="height: 55px;">
                                <span id="emailidError" style="color: red; font-size: 12px;"></span>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="Contact No"  id="contactno" name="contactno" style="height: 55px;">
                                <span id="contactnoError" style="color: red; font-size: 12px;"></span>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0 bg-light px-4 py-3" rows="5" id="details" name="details" placeholder="Message"></textarea>
                                <span id="detailsError" style="color: red; font-size: 12px;"></span>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let fields = ["fullname", "emailid", "contactno", "details"];
        let errorMessages = {
            fullname: "Full Name is required",
            emailid: "Enter a valid email (e.g., example@mail.com)",
            contactno: "Enter a valid 10-digit phone number",
            details: "Message cannot be empty"
        };

        function validateField(field) {
            let value = document.getElementById(field).value.trim();
            let errorElement = document.getElementById(field + "Error");
            if (field === "fullname") {
                let namePattern = /^[A-Za-z\s]+$/; // Only letters and spaces
                if (!value.match(namePattern)) {
                    errorElement.innerHTML = errorMessages[field];
                    return false;
                }
            } else if (field === "emailid") {
                let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
                if (!value.match(emailPattern)) {
                    errorElement.innerHTML = errorMessages[field];
                    return false;
                }
            } else if (field === "contactno") {
                let phonePattern = /^[6-9]\d{9}$/;
                if (!value.match(phonePattern)) {
                    errorElement.innerHTML = errorMessages[field];
                    return false;
                }
            } else {
                if (value === "") {
                    errorElement.innerHTML = errorMessages[field];
                    return false;
                }
            }
            errorElement.innerHTML = "";
            return true;
        }

        function showError(field) {
            fields.forEach(f => {
                document.getElementById(f + "Error").innerHTML = (f === field) ? errorMessages[field] : "";
            });
        }

        fields.forEach(field => {
            let inputElement = document.getElementById(field);
            let errorElement = document.getElementById(field + "Error");

            inputElement.addEventListener("focus", () => showError(field));
            inputElement.addEventListener("mouseover", () => showError(field));
            inputElement.addEventListener("mouseout", () => errorElement.innerHTML = "");
            inputElement.addEventListener("input", () => validateField(field));
        });
    });
</script>

<?php include("jsslink.php") ?>
</html>