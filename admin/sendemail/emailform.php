<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


   <?php 
  session_start();
   include('../../class/dataclass.php');
   $dc=new dataclass();
   $regid="";
   $username="";
   $emailid="";
   $msg="";
   
   if(isset($_SESSION['userid']))
   {
    $userid=$_SESSION['userid'];
    $query="select regid,username,emailid from registration where regid='$userid'";
    $rw=$dc->getrow($query);
    if($rw)
    {
        $regid=$rw['regid'];
        $username=$rw['username'];
        $emailid=$rw['emailid'];
    }
   }
   ?>
   <?php
     
      $msg="";
      if(isset($_SESSION ['msg']))
      {
        $msg=$_SESSION['msg'];
      }
        
    ?>
    
    <style>
        /* 🌟 General Body Styling */
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        /* 🌟 Form Container Styling */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-weight: bold;
        }

        /* 🌟 Input Fields Styling */
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease-in-out;
            padding: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        /* 🌟 Textarea Styling */
        textarea.form-control {
            resize: none;
            height: 120px;
        }

        /* 🌟 Button Styling */
        .btn-custom {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            background-color: #28a745;
            border: none;
            color: white;
            transition: 0.3s ease-in-out;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        /* 🌟 Message Display */
        .msg {
            text-align: center;
            font-size: 16px;
            color: #d9534f;
            margin-top: 10px;
        }
    </style>
    
</head>
<body>
<form action="../sendemail/emailsend.php" method="post">
        <div class="form-container">
            <h2>Send Email</h2>

            <div class="mb-6">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" value="<?php echo $username; ?>" name="username" required>
            </div>

            <div class="mb-6">
                <label class="form-label">Email Address</label>
                <input class="form-control" type="email" value="<?php echo $emailid; ?>" name="emailto" required>
            </div>

            <div class="mb-6">
                <label class="form-label">Subject</label>
                <input class="form-control" type="text" name="subject" required>
            </div>

            <div class="mb-6">
                <label class="form-label">Message</label>
                <textarea class="form-control" name="message" required></textarea>
            </div>

            <button type="submit" class="btn btn-custom">Send</button>

            <div class="msg">
                <?php echo $msg ?>
            </div>
        </div>
    </form>

</body>

