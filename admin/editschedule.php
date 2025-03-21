<?php
session_start();
include("../class/dataclass.php");

$dc = new dataclass();
$msg = "";

if (isset($_GET['id'])) {
    $schedule_id = $_GET['id'];
    $query = "SELECT * FROM doctor_schedule WHERE schedule_id = '$schedule_id'";
    $schedule = $dc->getrow($query);
}

if (isset($_POST['update'])) {
    $doctorname = $_POST['docname'];
    $available_days = implode(", ", $_POST['available_days']);
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $query = "UPDATE doctor_schedule SET 
              docname='$docname', available_days='$available_days', 
              start_time='$start_time', end_time='$end_time' 
              WHERE schedule_id='$schedule_id'";

    if ($dc->executeQuery($query)) {
        $msg = "Schedule updated successfully!";
        header("Location: showschedule.php");
    } else {
        $msg = "Error updating schedule.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Schedule</title>
    <?php include("csslink.php"); ?>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="container mt-4">
        <h2>Edit Doctor Schedule</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Doctor Name:</label>
                <input type="text" class="form-control" name="docname" value="<?php echo $schedule['docname']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Available Days:</label><br>
                <?php $days = explode(", ", $schedule['available_days']); ?>
                <input type="checkbox" name="available_days[]" value="Monday" <?php if (in_array("Monday", $days)) echo "checked"; ?>> Monday
                <input type="checkbox" name="available_days[]" value="Tuesday" <?php if (in_array("Tuesday", $days)) echo "checked"; ?>> Tuesday
                <input type="checkbox" name="available_days[]" value="Wednesday" <?php if (in_array("Wednesday", $days)) echo "checked"; ?>> Wednesday
                <input type="checkbox" name="available_days[]" value="Thursday" <?php if (in_array("Thursday", $days)) echo "checked"; ?>> Thursday
                <input type="checkbox" name="available_days[]" value="Friday" <?php if (in_array("Friday", $days)) echo "checked"; ?>> Friday
                <input type="checkbox" name="available_days[]" value="Saturday" <?php if (in_array("Saturday", $days)) echo "checked"; ?>> Saturday
                <input type="checkbox" name="available_days[]" value="Sunday" <?php if (in_array("Sunday", $days)) echo "checked"; ?>> Sunday
            </div>

            <div class="mb-3">
                <label class="form-label">Start Time:</label>
                <input type="time" class="form-control" name="start_time" value="<?php echo $schedule['start_time']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">End Time:</label>
                <input type="time" class="form-control" name="end_time" value="<?php echo $schedule['end_time']; ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Schedule</button>
        </form>
        <br>
        <p><?php echo $msg; ?></p>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
