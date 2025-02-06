<?php 
    session_start();
    include ("../class/dataclass.php");
   
     ?>
     <?php 
     $regdate="";
     $username="";
     $password="";
     $emailid="";
     $contactno="";
     $query="";
     $msg="";
     $dc=new dataclass();
     ?>
     <?php 
     if(isset($_POST['btn1'])) 
     {
        $regdate=date('y-m-d');
        $username=$_POST['username'];
        $password=$_POST['password'];
        $emailid=$_POST['emailid'];
        $contactno=$_POST['contactno'];
        $query="INSERT INTO `registration`( `regdate`, `username`, `password`, `emailid`, `contactno`) VALUES ('$regdate','$username','$password','$emailid','$contactno')";
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
            die("error".mysqli_error($dc));
        }
     }

     ?>
     <?php 
     include("csslink.php") ?>
  <?php 
     $regdate="";
     $password="";
     $emailid="";
     $query="";
     $msg="";
     $dc=new dataclass();
  ?>

  <?php
  if(isset($_POST['btn']))
  {
     $password=$_POST['password'];
     $emailid=$_POST['emailid'];
     $result=$dc->getrow($query);
  }
  ?>