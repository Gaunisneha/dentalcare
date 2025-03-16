<!DOCTYPE html>
 <html lang="en">
 <head>
    <?php
    // session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <link href="css/style.css" rel="stylesheet">
 <body>
 <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="index.html" class="navbar-brand p-0">
            <h1 class="m-0 text-primary"><i class="fa fa-tooth me-2"></i>Dental Health care</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="mainhome.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="doctor.php" class="nav-item nav-link">Doctor</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <a href="profiletem.php" class="nav-item nav-link">Profile</a>
                <div class="nav-item dropdown"> 
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></a>
                    <div class="dropdown-menu m-0">
                        <!-- <a href="../home/mainhome.php">Patient</a><br> -->
                        <a href="../doctor/doctorlogin.php">Doctor</a><br>
                        <a href="../admin/adminlogin.php">Admin</a>
                    </div>
                </div>
            </div>
            
            <?php if(!isset($_SESSION['username'])){
                ?>
            <a href="loginpage.php" class="btn btn-primary py-2 px-4 ms-3">Login</a>
            <?php 
            }
            else if (isset($_SESSION['username'])){
                ?>
                <a href="logout.php" class="btn btn-primary py-2 px-4 ms-3">Logout</a>
                <?php
            } ?>
        </div>
    </nav>
 </body>
 </html>