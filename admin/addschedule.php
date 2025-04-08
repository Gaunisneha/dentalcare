<?php
session_start();
include("../class/dataclass.php");

$dc = new dataclass();
$msg = "";
$docname="";

if (isset($_SESSION['docid'])) {
    $docid = $_SESSION['docid'];

    // Fetch doctor name from `dentist` table
    $query = "SELECT docname FROM dentist WHERE docid = '$docid'";
    $result = $dc->getrow($query);

    if ($result) {
        $docname = $result['docname'];
    }
}

if (isset($_POST['submit'])) {
    $docname = $_POST['docname'];
    $available_days = implode(", ", $_POST['available_days']); // Convert array to string
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $query = "INSERT INTO doctor_schedule (docname, available_days, start_time, end_time) 
              VALUES ('$docname', '$available_days', '$start_time', '$end_time')";

    $result = $dc->executeQuery($query);

    if ($result) {
        $msg = "Schedule added successfully!";
    } else {
        $msg = "Error adding schedule.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Schedule</title>
    <?php include("csslink.php"); ?>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="container mt-4">
        <h2>Add Dentist Schedule</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Dentist Name:</label>
                <input type="text" class="form-control" name="docname" value="<?php echo $docname; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Available Days:</label><br>
                <input type="checkbox" name="available_days[]" value="Monday"> Monday
                <input type="checkbox" name="available_days[]" value="Tuesday"> Tuesday
                <input type="checkbox" name="available_days[]" value="Wednesday"> Wednesday
                <input type="checkbox" name="available_days[]" value="Thursday"> Thursday
                <input type="checkbox" name="available_days[]" value="Friday"> Friday
                <input type="checkbox" name="available_days[]" value="Saturday"> Saturday
                <input type="checkbox" name="available_days[]" value="Sunday"> Sunday
            </div>

            <div class="mb-3">
                <label class="form-label">Start Time:</label>
                <input type="time" class="form-control" name="start_time" required>
            </div>

            <div class="mb-3">
                <label class="form-label">End Time:</label>
                <input type="time" class="form-control" name="end_time" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Add Schedule</button>
        </form>
        <br>
        <p><?php echo $msg; ?></p>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
