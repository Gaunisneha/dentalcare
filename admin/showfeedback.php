<!DOCTYPE html>
<html lang="en">
<head>
 <?php 
     session_start();
     include("csslink.php");
     include("../class/dataclass.php");
     ?>
     <?php
        $fdid="";
        $dc= new dataclass();
        $query="";
        $msg=""; 
        $count=0;
     ?>
     <?php    
        
    
    if(isset($_POST['bdelete']))
    {
        $fdid=$_POST['bdelete'];
        $query="delete from  feedback where fdid='$fbid'";
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
                        <h2 class="text-center">Feedback Data</h2>
                    </div>
                    <!-- <div class="col-md-1">
                         <input type="submit" class="btn btn-success" name="bnew" value="new">
                    </div> -->
                  </div>
                  <div class="row">
                  <div class="col-md-11 p-3">
                         <input type="text" placeholder="Search" id="myInput" class="form-control"  >
                    </div>
                    <div class="row">
                    <div class="12">
                        <table class="table table-bordered">
                            <thead>
                    <tr>
                        <th>FEEDID</th>
                        <th>FEEDNAME</th>
                        <th>FEEDBACK</th>
                        <th>DELETE</th>
                    </tr>
                            </thead>
                            <tbody id="myTable">
                    
                    <?php 
                    $query="select * from feedback  ";
                    $tb=$dc->gettable($query);
                    while($rw=mysqli_fetch_array($tb))
                    {
                        echo("<tr>");
                        echo("<td>".$rw['fbid']."</td>");
                        echo("<td>".$rw['feedname']."</td>");
                       
                        echo("<td>".$rw['feedback']."</td>");
                        echo("<td><button class='btn btn-danger m-1' type='submit' name='bdelete' value=".$rw['fbid'].">Delete Data</button></td>");
                    
                        echo("</tr>");
                        $count++;
                    }
                    ?>
                    </tbody>
                    </table>
                    </div>
                    <span>Total Contacts:<?php echo($count)?></span>
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