<?php
include("../class/dataclass.php");

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $medical_history = $_POST['medical_history'];
    $emergency_contact_name = $_POST['emergency_contact_name'];
    $emergency_contact_phone = $_POST['emergency_contact_phone'];

    // Create the SQL query
    $query = "INSERT INTO patients (first_name, last_name, gender, dob, email, phone, address, medical_history, emergency_contact_name, emergency_contact_phone) 
              VALUES ('$first_name', '$last_name', '$gender', '$dob', '$email', '$phone', '$address', '$medical_history', '$emergency_contact_name', '$emergency_contact_phone')";
    
    // Execute the query
    $dc = new dataclass();
    $result = $dc->insertrecord($query);

    if ($result) {
        echo "Patient profile created successfully!";
    } else {
        echo "Error: " . mysqli_error($dc);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'csslink.php'?>
</head>
<body>
<form action="#" method="POST">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" required><br>

    <label for="gender">Gender:</label>
    <select name="gender" id="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" id="phone" required><br>

    <label for="address">Address:</label>
    <textarea name="address" id="address"></textarea><br>

    <label for="medical_history">Medical History:</label>
    <textarea name="medical_history" id="medical_history"></textarea><br>

    <label for="emergency_contact_name">Emergency Contact Name:</label>
    <input type="text" name="emergency_contact_name" id="emergency_contact_name"><br>

    <label for="emergency_contact_phone">Emergency Contact Phone:</label>
    <input type="text" name="emergency_contact_phone" id="emergency_contact_phone"><br>

    <input type="submit" name="submit" value="Save Patient Profile">
</form>

</body>
</html>