<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    session_start();
    include ("../class/dataclass.php");
     
     ?>
     <?php 
     $appfor="";
     $docid="";
     $name="";
     $emailid="";
     $appdate="";
     $apptime="";
     $remark="";
     $query="";
     $query1="";
     $query2="";
     $msg="";
     $dc=new dataclass();
     ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php   include("csslink.php") ?>
    
</head>


<body>
<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById("appdate").setAttribute("min", today);

        // Add event listeners for real-time validation
        document.getElementById("appdate").addEventListener("input", validateDate);
        document.getElementById("apptime").addEventListener("input", validateTime);
    });
    
    function validateForm() {
    let valid = true;
    if (!validateService()) valid = false;
    if (!validateDoctor()) valid = false;
    if (!validateName()) valid = false;
    if (!validateEmail()) valid = false;
    if (!validateDate()) valid = false;
    if (!validateTime()) valid = false;
    if (!validateRemark()) valid = false;
    return valid;
}

// ✅ Validate Service Selection
function validateService() {
    let appfor = document.getElementById("appfor").value;
    let errorMsg = document.getElementById("serviceError");
    if (appfor === "Select Service") {
        errorMsg.innerText = "❌ Please select a service.";
        errorMsg.style.color = "red";
        return false;
    }
    errorMsg.innerText = "";
    return true;
}

// ✅ Validate Doctor Selection
function validateDoctor() {
    let doctor = document.getElementById("doctors").value;
    let errorMsg = document.getElementById("doctorError");
    if (doctor === "Select Doctor") {
        errorMsg.innerText = "❌ Please select a doctor.";
        errorMsg.style.color = "red";
        return false;
    }
    errorMsg.innerText = "";
    return true;
}

// ✅ Validate Patient Name
function validateName() {
    let name = document.getElementById("patientname").value.trim();
    let errorMsg = document.getElementById("nameError");
    if (name === "") {
        errorMsg.innerText = "❌ Name is required.";
        errorMsg.style.color = "red";
        return false;
    }
    errorMsg.innerText = "";
    return true;
}

// ✅ Validate Email Format
function validateEmail() {
    let email = document.getElementById("emailid").value.trim();
    let errorMsg = document.getElementById("emailError");
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        errorMsg.innerText = "❌ Email is required.";
        errorMsg.style.color = "red";
        return false;
    } else if (!emailPattern.test(email)) {
        errorMsg.innerText = "❌ Invalid email format.";
        errorMsg.style.color = "red";
        return false;
    }
    errorMsg.innerText = "";
    return true;
}
    function validateDate() {
        let appDate = document.getElementById("appdate").value;
        let errorMsg = document.getElementById("dateError");
        
        let today = new Date();
        let selectedDate = new Date(appDate);
        today.setHours(0, 0, 0, 0); // Reset time for comparison

        if (selectedDate < today) {
            errorMsg.innerText = "❌ You cannot book an appointment for a past date.";
            errorMsg.style.color = "red";
        } else {
            errorMsg.innerText = "";
        }
    }

    function validateTime() {
        let appTime = document.getElementById("apptime").value;
        let errorMsg = document.getElementById("timeError");

        if (appTime) {
            let [hour, minute] = appTime.split(":").map(Number);
            if (hour < 8 || hour > 22) {
                errorMsg.innerText = "❌ Appointments are available only between 8:00 AM - 10:00 PM.";
                errorMsg.style.color = "red";
            } else {
                errorMsg.innerText = "";
            }
        }
    }
</script>

<?php   include("topbar.php") ?> 
<?php   include("header.php") ?> 
<?php 
     if(isset($_POST['btn1'])) 
     {
        if(isset($_SESSION['regid']))        {
        $appfor=$_POST['appfor'];
        $docid=$_POST['doctors'];   
        $patientname=$_POST['patientname'];
        $emailid=$_POST['emailid'];
        $appdate=$_POST['appdate'];
        $apptime = date("H:i:s", strtotime($_POST['apptime']));
        // $apptime=$_POST['apptime'];
        $remark=$_POST['remark'];
        
        
        
        $query="INSERT INTO `appointment`(`appfor`, `docid`, `patientname`,`emailid`, `appdate`, `apptime`, `remark`, `status`) VALUES ('$appfor','$docid','$patientname','$emailid','$appdate','$apptime','$remark','Pending')";
        $result=$dc->insertrecord($query);

        if($result)
        {
            
             $msg="Appointment booked successfully";
        }
        else
        {
            $msg="Appointment booking failed";
            
        }
    
 }
else
{
    echo "<script> alert('Please fill Appoinment Details!!!!'); window.location.href='appointment.php'; </script>";           
}
    }
     ?>

    <!-- Appointment Start -->
<div class="container-fluid bg-primary bg-appointment my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="display-5 text-white mb-4">We Are A Certified and Award Winning Dental Clinic You Can Trust</h1>
                        <p class="text-white mb-0">Oral health is all about the mouth. Your teeth, gums and your mouth should be bacteria free. It is much important for your overall health too. Poor oral health leads towards other problems of ear, nose and throat as well. Our whole body functioning is linked with each other, but the oral health is the most important one.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="appointment-form h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">Make Appointment</h1>
                        <form method="post" action="#" name="appointmentForm" id="appointmentForm" onsubmit="return validateForm();">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <select name="appfor"  id="appfor" class="form-select bg-light border-0" style="height: 55px;">
                                        <option selected>Select Service</option>
                                        <?php
                                        $query2="select serviceid,servicename from services ";
                                        $tb=$dc->gettable($query2);
                                        while($rw=mysqli_fetch_array($tb))
                                        {
                                            if($serviceid==$rw['serviceid'])
                                            {
                                                echo"<option value=".$rw['servicename'].">".$rw['servicename']."</option>";
                                            }
                                            else
                                            {
                                                echo"<option value=".$rw['servicename'].">".$rw['servicename']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <small id="serviceError" class="error-message"></small>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <select name="doctors" id="doctors" class="form-select bg-light border-0" style="height: 55px;">
                                    <option selected>Select Doctor</option>
                                        <?php
                                        $query1="select docid,docname from dentist where status='Active'";
                                        $tb=$dc->gettable($query1);
                                        while($rw=mysqli_fetch_array($tb))
                                        {
                                            if($docid==$rw['docid'])
                                            {
                                                echo"<option value=".$rw['docid'].">".$rw['docname']."</option>";
                                            }
                                            else
                                            {
                                                echo"<option value=".$rw['docid'].">".$rw['docname']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <small id="doctorError" class="error-message"></small>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-light border-0"  id="patientname" name="patientname" placeholder="Your Name" style="height: 55px;">
                                    <small id="nameError" class="error-message"></small>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-light border-0" id="emailid" name="emailid" placeholder="Your Email" style="height: 55px;">
                                    <small id="emailError" class="error-message"></small>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="date" id="appdate"
                                            class="form-control bg-light border-0 "
                                            placeholder="Appointment Date" name="appdate" data-toggle="datetimepicker" style="height: 55px;">
                                            <small id="dateError" class="error-message"></small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="time" id="time1" data-target-input="nearest">
                                        <input type="time" id="apptime"
                                            class="form-control bg-light border-0 "
                                            placeholder="Appointment Time"  name="apptime"  min="08:00" max="22:00" data-toggle="datetimepicker" style="height: 55px;">
                                            <small id="timeError" class="error-message"></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="textarea" class="form-control bg-light border-0" name="remark" placeholder="Your Remark" style="height: 55px; ">
                                </div>
                                
                                <div class="col-12">
                                    <input class="btn btn-dark w-100 py-3" name="btn1" type="submit" value="Make Appointment">
                                </div>
                                <?php echo $msg ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
    <?php   include("footer.php") ?> 
    <?php   include("jsslink.php") ?> 

    
    <!-- Template Javascript -->
    <!-- <script src="js/main.js"></script> -->
</body>
</html>