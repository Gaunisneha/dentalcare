<?php
session_start();
include("../class/dataclass.php");

$dc = new dataclass();
$query = "SELECT * FROM doctor_schedule";
$schedules = $dc->gettable($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dentist Schedules</title>
    <?php include("csslink.php"); ?>
</head>
<body>
    
    <?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
    <div class="container mt-4">
        <h2>Dentist Schedules</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Dentist Name</th>
                    <th>Available Days</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($schedules)) { ?>
                    <tr>
                        <td><?php echo $row['schedule_id'];?></td>
                        <td><?php echo $row['docname']; ?></td>
                        <td><?php echo $row['available_days']; ?></td>
                        <td><?php echo $row['start_time']; ?></td>
                        <td><?php echo $row['end_time']; ?></td>
                        <td>
                          
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
