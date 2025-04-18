<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("csslink.php");
     include("../class/dataclass.php");
     ?>
     <?php
        $regid="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
        $count=0;
     ?>
     <?php    
        if(isset($_POST['bnew']))
        {
            $_SESSION['trans']='new';
            header('location:appointmantform.php');
        
        }

    if(isset($_POST['bupdate']))
    {
        $regid=$_POST['bupdate'];
        $_SESSION['appid']=$appid;
        $_SESSION['trans']='update';
        header('location:appointmentform.php');
    }
    if(isset($_POST['bdelete']))
    {
        $appid=$_POST['bdelete'];
        $query="delete from appointment  where appid='$appid'";
        $result=$dc->deleterecord($query);
        if($result)
        {
            $msg="Delete record Successfully...";
        }
        else{
            $msg="Record not deleted...";
        }
    }
    ?>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
    
<?php include("slider.php"); ?>

   <div class="content">
   <?php include("header.php"); ?>

   <form action="#" method="POST">
        <main id="main" class="main">
            <section class="section dashboard">
                  <div class="row" mb-3>
                    <div class="col-md-10">
                        <h2 class="text-center">Appointment Data</h2>
                    </div>
                    <div class="col-md-2">
                         <input type="text" placeholder="Search" id="myInput" class="form-control"  >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                    <tr>
                        <th>APPID</th>
                        <th>APPFOR</th>
                        <th>DOCNAME</th>
                        <th>PATIENTNAME</th>
                        <th>EMAILID</th>
                        <th>APPDATE</th>
                        <th>APPTIME</th>
                        <th>REMARK</th>
                        <!-- <th>STATUS</th> -->
                        <th>DELETE</th>
                        <!-- <th>UPDATE</th> -->
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                    $query="select * from appointment  ";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['appid']."</td>");
                        echo("<td>".$rw['appfor']."</td>");
                        echo("<td>".$rw['docid']."</td>");
                        echo("<td>".$rw['patientname']."</td>");
                        echo("<td>".$rw['emailid']."</td>");
                        echo("<td>".$rw['appdate']."</td>");
                        echo("<td>".$rw['apptime']."</td>");
                        echo("<td>".$rw['remark']."</td>");
                        // echo("<td>".$rw['status']."</td>");
                        echo("<td><button class='btn btn-danger btn-sm delete-btn' type='button' name='bdelete' value=".$rw['appid'].">
                        <i class='fas fa-trash-alt'></i></button></td>");
                        // echo("<td><button class='btn btn-warning btn-sm' type='button' name='bupdate' value=".$rw['appid'].">
                        //  <i class='fas fa-edit'></i></button></td>");
                        echo("</tr>");
                        $count++;
                    }
                    ?>
                    </tbody>
                    </table>
                    <script>
$(document).ready(function() {
    $('.delete-btn').on('click', function() {
        var appid = $(this).data('appid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this appointment deletion!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#deleteAppId').val(appid);  // Set hidden input
                $('form').submit();            // Submit form
            }
        });
    });
});
</script>

                    <span>Total Appointments: <?php echo($count)?></span>
                    </div>
                  </div>
            </section>       
</main>
    </form>
    <input type="hidden" name="bdelete" id="deleteAppId">
    <input type="hidden" name="bupdate" id="updateAppId">
    <?php include("footer.php"); ?>
   </div>
   <?php include("jslink.php"); ?>
</body>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</html>