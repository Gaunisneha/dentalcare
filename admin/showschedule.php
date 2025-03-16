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
    <title>Doctor Schedules</title>
    <?php include("csslink.php"); ?>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="container mt-4">
        <h2>Doctor Schedules</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Available Days</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($schedules)) { ?>
                    <tr>
                        <td><?php echo $row['docname']; ?></td>
                        <td><?php echo $row['available_days']; ?></td>
                        <td><?php echo $row['start_time']; ?></td>
                        <td><?php echo $row['end_time']; ?></td>
                        <td>
                            <a href="editschedule.php?id=<?php echo $row['schedule_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="deleteschedule.php?id=<?php echo $row['schedule_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
