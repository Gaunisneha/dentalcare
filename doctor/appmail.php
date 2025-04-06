
<?php 

    include("../class/dataclass.php");
    ?>
    <?php
      $dc=new dataclass();
      $msg="";
        ?>

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

                $updateQuery = "UPDATE appointment SET status='Active' WHERE appid='$appid'";
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
                      window.location.href = '../doctor/appointment.php'; // Redirect to refresh the page
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