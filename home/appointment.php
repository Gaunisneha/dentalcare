<!DOCTYPE html>
<html lang="en">
<head>

<?php   include("topbar.php") ?> 
<?php   include("header.php") ?> 
<?php
    // session_start();
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    // let namePattern = /^[A-Za-z\s]+$/; 
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
        today.setHours(0, 0, 0, 0);

    let maxDate = new Date();
    maxDate.setMonth(maxDate.getMonth() + 1);
    maxDate.setHours(0, 0, 0, 0);

    if (!appDate) {
        errorMsg.innerText = "❌ Please select an appointment date.";
        errorMsg.style.color = "red";
        return false;
    }
        if (selectedDate < today) {
            errorMsg.innerText = "❌ You cannot book an appointment for a past date.";
        errorMsg.style.color = "red";
        return false;

    } 
    else if (selectedDate > maxDate) {
        errorMsg.innerText = "❌ You can only book an appointment within the next 1 months.";
        errorMsg.style.color = "red";
        return false;
    } 
    else if (selectedDate.getDay() === 0) {
        errorMsg.innerText = "❌ Sorry, we are closed on Sundays.";
        errorMsg.style.color = "red";
        return false;
    } else {
        errorMsg.innerText = "";
        return true;
    }
}
    function validateTime() {
        let appTime = document.getElementById("apptime").value;
        let errorMsg = document.getElementById("timeError");

        if (appTime) {
            let [hour, minute] = appTime.split(":").map(Number);
            if (hour < 8 || hour > 20) {
                errorMsg.innerText = "❌ Appointments are available only between 8:00 AM - 8:00 PM.";
                errorMsg.style.color = "red";
            } else {
                errorMsg.innerText = "";
            }
        }
    }
</script>

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
        $price = isset($_POST['price']) ? $_POST['price'] : 0; 
        // $apptime=$_POST['apptime'];
        $remark=$_POST['remark'];
        
        if ($appfor == "Select Service" || $docid == "Select Doctor" || $patientname == "" || 
            $emailid == "" || $appdate == "" || $apptime == "") {
            echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incomplete Details',
                        text: '❌ Please fill in all the appointment details!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='appointment.php';
                        }
                    });
                  </script>";
            exit();
        }

        $query = "INSERT INTO `appointment`(`appfor`, `docid`, `patientname`, `emailid`, `appdate`, `apptime`, `price`, `remark`, `status`) 
        VALUES ('$appfor', '$docid', '$patientname', '$emailid', '$appdate', '$apptime', '$price', '$remark', 'Pending')";
        
$result = $dc->insertrecord($query);

if ($result) {

    
    // Assuming $dc->conn is the database connection

  // Store appointment details in session
  $_SESSION['appointment_details'] = [
    //   'appid' => $appointment_id, // Store appid
      'patientname' => $patientname,
      'emailid' => $emailid,
      'docname' => $dc->gettable("SELECT docname FROM dentist WHERE docid='$docid'"), // Fetch doctor name
      'service' => $appfor,
      'appdate' => $appdate,
      'apptime' => $apptime,
      'price' => $price,
      'remark' => $remark
  ];
  
  
  // Show success message and redirect
  echo "<script>
      Swal.fire({
          icon: 'success',
          title: 'Appointment Booked!',
          text: '✅ Your appointment has been successfully scheduled.',
          confirmButtonColor: '#28a745',
          confirmButtonText: 'OK'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href='appointment_confirmation.php';
          }
      });
  </script>";
  exit();
}

        
        // if($result)
        // {
        //     echo "<script>
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Appointment Booked!',
        //                 text: '✅ Your appointment has been successfully scheduled.',
        //                 confirmButtonColor: '#28a745',
        //                 confirmButtonText: 'OK'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     window.location.href='appointment_confirmation.php';
        //                 }
        //             });
        //           </script>";
        //           $_SESSION['price']=$price;
        //     //  $msg="Appointment booked successfully";
        // }
        else
        {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Booking Failed',
                text: '❌ Unable to book the appointment. Please try again!',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='appointment.php';
                }
            });
          </script>";
            // $msg="Appointment booking failed";
            
        }
 }
 
else
{
    echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Session Expired',
                    text: '❌ Please log in again to book an appointment!',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href='loginpage.php';
                    }
                });
              </script>";   
    // echo "<script> alert('Please fill Appoinment Details!!!!'); window.location.href='appointment.php'; </script>";           
}
    }
     ?>
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
                                       
                                    </select>
                                    <small id="serviceError" class="error-message"></small>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <select name="doctors" id="doctors" class="form-select bg-light border-0" style="height: 55px;" onchange="fetchServices()">
                                    <option selected>Select Doctor</option>
                                        <?php
                                        $query1="select docid,docname from dentist where status='Active'";
                                        $tb=$dc->gettable($query1);
                                        while($rw=mysqli_fetch_array($tb))
                                        {
                                            echo "<option value='{$rw['docid']}'>{$rw['docname']}</option>";

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
                                            placeholder="Appointment Date" name="appdate" data-toggle="datetimepicker" onchange="validateDate()" style="height: 55px;">
                                            <small id="dateError" class="error-message"></small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="time" id="time1" data-target-input="nearest">
                                        <input type="time" id="apptime"
                                            class="form-control bg-light border-0 "
                                            placeholder="Appointment Time"  name="apptime"  min="08:00" max="20:00" onchange="validateTime()" data-toggle="datetimepicker" style="height: 55px;">
                                            <small id="timeError" class="error-message"></small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-light border-0" id="price" name="price" placeholder="Price" style="height: 55px;" readonly>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="textarea" class="form-control bg-light border-0" name="remark" placeholder="Your Remark" style="height: 55px; ">
                                </div>
                                
                                <div class="col-12">
                                    <input class="btn btn-dark w-100 py-3" name="btn1" type="submit" value="Make Appointment">
                                </div>
                                <!-- <p class="text-white"></p> -->
                                <?php echo $msg ?>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
   function updatePrice() {
    let serviceDropdown = document.getElementById("appfor");
    let priceField = document.getElementById("price");

    let selectedOption = serviceDropdown.options[serviceDropdown.selectedIndex];
    let price = selectedOption.getAttribute("data-price") || "";

    priceField.value = price;
}

document.getElementById("appfor").addEventListener("change", updatePrice);

    function fetchServices() {
    let doctorId = document.getElementById("doctors").value;
    let serviceDropdown = document.getElementById("appfor");

    if (doctorId === "Select Doctor") {
        serviceDropdown.innerHTML = "<option selected>Select Service</option>";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_services.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            serviceDropdown.innerHTML = xhr.responseText;
            updatePrice(); // Update price if necessary
        }
    };

    xhr.send("doctorId=" + doctorId);
}
</script>
    <!-- Appointment End -->
    <?php   include("footer.php") ?> 
    <?php   include("jsslink.php") ?> 

    
    <!-- Template Javascript -->
    <!-- <script src="js/main.js"></script> -->
</body>
</html>