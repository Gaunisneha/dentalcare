<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php 
    include ("../doctor/csslink.php");
    include("../class/dataclass.php");
    ?>
    <?php
      $dc=new dataclass();
      $msg="";
        ?>
         <style>
    /* Custom Styles */
    .content {
        padding: 20px;
    }
    h2 {
        font-size: 28px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }
    .table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .table th {
        background-color: #f4f4f4;
        font-weight: 600;
    }
    .table td {
        background-color: #fff;
    }
    .table td button {
        margin-right: 10px;
    }
    .form-control {
        max-width: 300px;
        margin-bottom: 15px;
    }
    .row {
        margin-bottom: 15px;
    }
    .btn {
        font-size: 14px;
        padding: 6px 12px;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .text-center {
        text-align: center;
    }
  </style>
</head>
<body>
     
    <!-- Spinner End -->
<?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
<form action="#" method="POST">
        <main id="main" class="main">
            <section class="section dashboard">
                  <div class="row">
                    <div class="col-md-11">
                        <h2 class="text-center pt-2 "> Appointment details</h2>
                    </div>
                    </div>
                    <div class="row">

                    <div class="col-md-12 p-3">
                         <input type="text" placeholder="Search" id="myInput" class="form-control"  >
                    </div>
                    <br>

                  </div>
                  <div class="row">
                    <div class="12">
                        <table class="table table-bordered">
                            <thead>
                            
                    <tr>
                        <th>PATIENT NAME</th>
                        <th>EMAILID</th>
                        <th>APPDATE</th>
                        <th>APPTIME</th>
                        <th>REMARK</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                   
                    $query="select * from appointment where docid=$docid";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['patientname']."</td>");
                        echo("<td>".$rw['emailid']."</td>");
                        echo("<td>".$rw['appdate']."</td>");
                        echo("<td>".$rw['apptime']."</td>");
                        echo("<td>".$rw['remark']."</td>");
                        echo("<td>".$rw['status']."</td>");
                        if('Pending'==$rw['status'])
                        {
                        echo("<td><button class='btn btn-success' type='submit' id='aprove' name='aprove' value=".$rw['appid'].">Aprove</button></td>");
                        }
                        else
                        {
                        echo("<td><button class='btn btn-danger' type='submit' name='bdelete' value=".$rw['appid'].">Delete Data</button>");

                        // echo("<button class='btn btn-danger ms-3' type='submit' name='bupdate' value=".$rw['appid'].">Update Data</button></td>");
                        }
                        
                    }
                    ?>
                    </tbody>
                    </table>
                    </div>
                  </div>
            </section>       
</main>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 
if(isset($_POST['aprove']))
        {
            $appid=$_POST['aprove'];

            $query = "SELECT emailid, patientname FROM appointment WHERE appid='$appid'";
            $result = $dc->getrecord($query);
            
            if ($result) {
                $email = $result['emailid'];
                $patientname = $result['patientname'];

                $updateQuery = "UPDATE appointment SET status='Paid' WHERE appid='$appid'";
                $updateResult = $dc->updaterecord($updateQuery);
        
                if ($updateResult) {
                    
                    $mail = new PHPMailer(true);
            try {
                // SMTP Configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username='manasiyamosinali1@gmail.com';             
                $mail->Password ='rzjdcgybzphcttog'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Email Content
                $mail->setFrom('manasiyamosinali1@gmail.com', 'Dental Health Care');
                $mail->addAddress($email, $patientname);
                $mail->Subject = 'Appointment Approved - Proceed to Payment';
                $mail->Body = "Dear $patientname,\n\nYour appointment has been approved! You can proceed for payment\n\nThank you,\nDental Health Care";

                // Send Email
                $mail->send();
              echo "<script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Appointment Approved!',
                      text: 'The patient has been notified about the approval.',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                  }).then(() => {
                      window.location.href = 'appointment.php'; // Redirect to refresh the page
                  });
              </script>";
              exit();

            } catch (Exception $e) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Notification Failed!',
                        text: 'Mailer Error: {$mail->ErrorInfo}',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                </script>";
                exit();
            }
              
          } else {
              echo "<script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Approval Failed!',
                      text: 'Something went wrong, please try again.',
                      confirmButtonColor: '#d33',
                      confirmButtonText: 'OK'
                  });
              </script>";
              exit();
          }
        }
    }
        if (isset($_POST['bdelete'])) {
            $appid = $_POST['bdelete'];
            $query = "DELETE FROM appointment WHERE appid='$appid'";
            $result = $dc->deleterecord($query);

            if ($result) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment Deleted!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'appointment.php';
                    });
                </script>";
                exit();
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Deletion Failed!',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                </script>";
                exit();
            }
        }
        ?>
    </form>
    
   </div>
   <!--  -->
   <?php include("jslink.php"); ?> 
</body>
</html>