<?php
include ("../class/dataclass.php");
$dc = new dataclass();

if (isset($_POST['doctorId'])) {
    $doctorId = $_POST['doctorId'];
    
    $query = "SELECT serviceid, servicename, price FROM services WHERE docid = '$doctorId'";
    $result = $dc->gettable($query);
    
    echo "<option selected>Select Service</option>";
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<option value='{$row['servicename']}' data-price='{$row['price']}'>{$row['servicename']}</option>";
    }
}
?>
