<!-- Sidebar Start -->
<?php 
    session_start();
    // include ("../class/dataclass.php");
    // $dc=new dataclass();
    $docid= $_SESSION['docid'] ; 
    $docname= $_SESSION['docname']; 
     ?>
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                <h3 class="m-0 text-primary"><i class="fa fa-tooth me-2"></i>Dental care</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        
                        <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                    </div>
                    
                </div>
                <div class="navbar-nav w-100">
                    <a href="doctorhome.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                      
                    </div>
                    <a href="doctor_schedule.php" class="nav-item nav-link"><i class="fa fa-user-nurse"></i>Doctor Schedule</a>
                    <!-- <a href="showregistration.php" class="nav-item nav-link"><i class="fa fa-users"></i>Patient List</a> -->
                    <a href="appointment.php" class="nav-item nav-link"><i class="fa fa-calendar-check"></i>Appointments</a>
                    
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
      