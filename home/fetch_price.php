<?php
include('../class/dataclass.php');
$dc = new DataClass();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["appid"])) {
    $appid = $_POST["appid"];
    
    // Debug: Print appid to ensure it's received
    error_log("Received appid: " . $appid);

    $query = "SELECT price FROM appointment WHERE appid = '$appid'";
    $priceRow = $dc->getrow($query);

    // Debug: Print SQL query result
    if ($priceRow) {
        error_log("Fetched price: " . $priceRow['price']);
        echo $priceRow['price'];
    } else {
        error_log("No price found for appid: " . $appid);
        echo "0"; // Return 0 if no record found
    }
}
?>
