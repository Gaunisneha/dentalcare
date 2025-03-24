   <!-- Navbar Start -->
   <?php 
    // session_start();
    include_once ("../class/dataclass.php");
    $dc=new dataclass();
    $docid= $_SESSION['docid'] ; 
    $docname= $_SESSION['docname']; 
     ?>
   <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                
                <div class="navbar-nav align-items-center ms-auto">
                <div class="ms-3">
                        <h6 class="mb-0">Dr. <?php echo $docname; ?> </h6>
                        <!-- <span>Admin</span> -->
                    </div>
                

                    <div class="nav-item dropdown">
                        
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            
                            
                    </div>
                    
                    <div class="nav-item dropdown">
                        
                        <!-- <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                       
                            <hr class="dropdown-divider">
                           
                            <hr class="dropdown-divider">
                            
                            <hr class="dropdown-divider">
                        </div> -->
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->