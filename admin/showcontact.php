<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("csslink.php");
     include("../class/dataclass.php");
     ?>
     <?php
        $docid="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
        $count=0;
     ?>
     <?php    
        if(isset($_POST['bnew']))
        {
            $_SESSION['trans']='new';
            header('location:contactform.php');
        
        }

    if(isset($_POST['bupdate']))
    {
        $contactid=$_POST['bupdate'];
        $_SESSION['contactid']=$contactcid;
        $_SESSION['trans']='update';
        header('location:contactform.php');
    }
    if(isset($_POST['bdelete']))
    {
        $contactid=$_POST['bdelete'];
        $query="delete from  contactus where contactid='$contactid'";
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
<body>
<?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
   <form action="#" method="POST">
        <main id="main" class="main">
            <section class="section dashboard">
                  <div class="row">
                    <div class="col-md-11">
                        <h2 class="text-center pt-2 ">Contact Details</h2>
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
                        <th>CONTACTID</th>
                        <th>DATE</th>
                        <th>Name</th>
                        <th>EMAILID</th>
                        <th>CONTACTNO</th>
                        <th>DETAILS</th>
                        <th>STATUS</th>
                        <th>DELETE</th>
                        <th>UPDATE</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php 
                    $query="select * from contactus";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['contactid']."</td>");
                        echo("<td>".$rw['contactdate']."</td>");
                        echo("<td>".$rw['fullname']."</td>");
                        echo("<td>".$rw['emailid']."</td>");
                        echo("<td>".$rw['contactno']."</td>");
                        echo("<td>".$rw['details']."</td>");
                        echo("<td>".$rw['status']."</td>");
                        echo("<td><button class='btn btn-danger' type='submit' name='bdelete' value=".$rw['contactid'].">Delete Data</button></td>");
                        echo("<td><button class='btn btn-success' type='submit' name='bupdate' value=".$rw['contactid'].">Update Data</button></td>");
                        echo("</tr>");
                        $count++;
                    }
                    ?>
                    </tbody>
                   
                   
                    
                    </table>
                    <span>Total Contacts:<?php echo($count)?></span>
                    </div>
                  </div>
            </section>       
</main>
    </form>
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