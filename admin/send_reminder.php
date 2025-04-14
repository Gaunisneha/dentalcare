<?php
include("../class/dataclass.php");
$dc = new dataclass();

$query = "SELECT appid, patientname, appdate, apptime FROM appointment WHERE appdate >= CURDATE()";
$result = $dc->gettable($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Appointment Reminder</title>
    <style>
    body {
    font-family: 'Poppins', sans-serif;
    background-color: #eef2f7;
    text-align: center;
    margin: 0;
    padding: 0;
}
.container {
    width: 50%;
    margin: 50px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
h2 {
    color: #007bff;
}
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
select, button {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ddd;
}
button {
    background: #007bff;
    color: white;
    cursor: pointer;
}
button:hover {
    background: #0056b3;
}
</style>
</head>
<body>
    
    <div class="container">
        <h2>Send Appointment Reminder</h2>
        <form action="reminder.php" method="post">
            <label for="appid">Select Appointment:</label>
            <select name="appid" required>
                <option value="">-- Select Appointment --</option>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['appid']; ?>">
                        <?php echo $row['patientname'] . " - " . $row['appdate'] . " at " . $row['apptime']; ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" name="send_reminder">Send Reminder</button>
        </form>
    </div>
</body>
</html>
