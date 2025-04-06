<?php
session_start();
include('../../class/dataclass.php');
$dc=new dataclass();
$username=$_POST['username'];
$emailfrom=$_POST['emailfrom'];
$emailto=$_POST['emailto'];
$subject=$_POST['subject'];
$message=$_POST['message'];  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host= 'smtp.gmail.com';                     
    $mail->SMTPAuth=true;                                   
    $mail->Username='manasiyamosinali1@gmail.com';              // Replace with your email
    $mail->Password ='rzjdcgybzphcttog';              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port=587;                                   
    
    $mail->setFrom('manasiyamosinali1@gmail.com','mosinali');
    $mail->addAddress($emailto,$username);     

   
    $mail->isHTML(true);                                        
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = 'none';

    $mail->send();
    $_SESSION['msg']='Message has been sent';
    $emaildate=date('y-m-d');
    $query="insert into email value(null,'$emaildate','$emailfrom','$emailto','$message','$subject','$regid')";
} 
catch (Exception $e)
{
    echo "Mailer Error: {$mail->ErrorInfo}";
    $_SESSION['msg']='Message could not be sent.';
}
header('location:emailform.php');    
?>
