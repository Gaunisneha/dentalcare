<!-- Sidebar Start -->
<?php 
    // session_start();
    // include ("../class/dataclass.php");
    // $dc=new dataclass();
    $adminid= $_SESSION['adminid'] ; 
    $adminname= $_SESSION['adminname']; 
     ?>
     
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                <h3 class="m-0 text-primary"><i class="fa fa-tooth me-2"></i>Dental Care</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../admin/img/admin2.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                    <h6 class="mb-0">Welcome <?php echo $adminname; ?> </h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="adminhome.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                    </div>
                    <a href="showdoctor.php" class="nav-item nav-link"><i class="fa fa-user-nurse"></i>Dentist</a>
                    <a href="showregistration.php" class="nav-item nav-link"><i class="fa fa-users"></i>User Data</a>
                    <a href="showappointment.php" class="nav-item nav-link"><i class="fa fa-calendar-check"></i>Appointments</a>
                    <a href="showschedule.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Dentist Schedule</a>
                    <a href="showfeedback.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Feedback</a>
                    <a href="showpayment.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Payment</a>
                    <a href="showservices.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Services</a>
                    <a href="send_reminder.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Reminder</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Contact Us</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="showcontact.php" class="dropdown-item">Show Contact</a>
                            <a href="contactinformation.php" class="dropdown-item">Edit information</a>
                            <!-- <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a> -->
                        </div>
                       
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->