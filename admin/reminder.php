<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include("../class/dataclass.php");

$dc = new dataclass();

if (isset($_POST['send_reminder'])) {
    $appid = $_POST['appid'];

    $query = "SELECT * FROM appointment WHERE appid = '$appid'";
    $result = $dc->gettable($query);
    $app = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM dentist";
    $result_doc = $dc->gettable($query);
    $app_dc = mysqli_fetch_assoc($result_doc);

    if (!$app) {
        echo "<p style='color:red;'>❌ No appointment found.</p>";
        exit;
    }
    else{

    // Fetch appointment details
    $emailid = $app['emailid'];
    $patientname = $app['patientname'];
    $email_doc = $app_dc['emailid'];
    $appdate = $app['appdate'];
    $apptime = $app['apptime'];
    $docname = $app_dc['docname'];

    // Email subject
    $subject = "Reminder: Upcoming Appointment on $appdate at $apptime";

    // Dentist
    $dentist_body = "
        <p>Dear Dr. $docname,</p>
        <p>This is a reminder that you have an upcoming appointment with patient $patientname on $appdate at $apptime.</p>
        <p>Please check your schedule accordingly.</p>
        <p>Best regards,<br>Dental Care System</p>
    ";

    // Patient
    $patient_body = "
        <p>Dear $patientname,</p>
        <p>This is a reminder for your upcoming appointment with Dr. $docname on $appdate at $apptime.</p>
        <p>Please ensure to arrive on time.</p>
        <p>Best regards,<br>Dental Care System</p>
    ";

    echo "<script>showLoadingSpinner();</script>";

echo "<script>hideLoadingSpinner();</script>";

    // Send emails
    $dentistSent = sendEmail($email_doc, $subject, $dentist_body);
    $patientSent = sendEmail($emailid , $subject, $patient_body);
    if ($dentistSent && $patientSent) {
      $message = "<p class='success'>✅ Reminder emails sent successfully!</p>";
  } else {
      $message = "<p class='error'>❌ Some emails could not be sent. Check your SMTP settings.</p>";
  }
  
  
}
} 
function sendEmail($to, $subject, $body) {
  $mail = new PHPMailer(true);
  try {
      // SMTP Configuration
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username='manasiyamosinali1@gmail.com';              
      $mail->Password ='rzjdcgybzphcttog';  
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      // Email details
      $mail->setFrom('manasiyamosinali1@gmail.com', 'Dental Care System');
      $mail->addAddress($to);

      // Email content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $body;

      // Send email
      $mail->send();
      
      // Send success message to console
      echo "Email sent successfully to $to.<br>";
      
      return true;  
  } catch (Exception $e) {
      return false;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Reminder</title>
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f4f8;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
}

.navbar {
    width: 100%;
    background-color: #007bff;
    padding: 15px 0;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

.navbar .nav-links {
    display: flex;
    justify-content: center;
}

.navbar .nav-links a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    margin: 0 20px;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
    border-radius: 5px;
}

.navbar .nav-links a:hover {
    background-color: #0056b3;
}

.container {
    width: 100%;
    max-width: 600px;
    background-color: #fff;
    padding: 30px;
    margin-top: 80px; /* space below the fixed navbar */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    transform-style: preserve-3d;
    perspective: 1500px;
    animation: rotateIn 0.8s ease-in-out;
}

p {
    padding: 15px;
    font-size: 16px;
    margin-top: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
    opacity: 0;
    animation: fadeInMessage 1s ease-out forwards;
}

p.success {
    background-color: #28a745;
    color: white;
    transform: scale(1);
}

p.error {
    background-color: #dc3545;
    color: white;
    transform: scale(1);
}

p:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

@keyframes fadeInMessage {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.spinner {
    border: 4px solid #f3f3f3; 
    border-top: 4px solid #3498db; 
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    margin: 10px auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


@media (max-width: 768px) {
    .navbar .nav-links a {
        font-size: 16px;
        margin: 0 15px;
    }

    .container {
        width: 90%;
        padding: 20px;
    }
}


    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-links">
            <a href="adminhome.php">Home</a>
            <a href="reminder.php">Send Reminder</a>
            
        </div>
    </nav>
    <div class="container">
        <?php if (isset($message)) { echo $message; } ?>
        <div class="spinner" id="loadingSpinner" style="display: none;"></div>
    </div>

</body>
<script>
    // Show loading spinner
    function showLoadingSpinner() {
        document.getElementById('loadingSpinner').style.display = 'block';
    }

    // Hide loading spinner
    function hideLoadingSpinner() {
        document.getElementById('loadingSpinner').style.display = 'none';
    }

</script>
</html>



