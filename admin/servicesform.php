<?php
session_start();
include("../class/dataclass.php");

// Initialize variables
$docid = "";
$servicename = "";
$price = "";

$dc = new dataclass();
$query = "";
$msg = "";

// Fetch service details if in update mode
if ($_SESSION['trans'] == 'update') {
    $serviceid = $_SESSION['serviceid'];
    $query = "SELECT * FROM services WHERE serviceid='$serviceid'";
    $rw = $dc->getrow($query);

    if ($rw) {
        $servicename = $rw['servicename'];
        $price = $rw['price'];
    } else {
        $msg = "Service not found.";
    }
}

// Handle form submission
if (isset($_POST['bsave'])) {
    $servicename = $_POST['servicename'] ?? "";
    $price = $_POST['price'] ?? "";

    // Validate inputs
    if (empty($servicename) || empty($price)) {
        $msg = "Service name and price are required!";
    } else {
        if ($_SESSION['trans'] == 'new') {
            // Insert new service
            $query = "INSERT INTO `services` (servicename, price) VALUES ('$servicename', '$price')";
            $result = $dc->insertrecord($query);

            if (!$result) {
                $msg = "Record not inserted.";
            }
        } elseif ($_SESSION['trans'] == 'update') {
            // Update existing service
            $query = "UPDATE services SET servicename='$servicename', price='$price' WHERE serviceid='$serviceid'";
            $result = $dc->updaterecord($query);

            if (!$result) {
                $msg = "Record not updated.";
            }
        }

        // If successful, redirect
        if (isset($result) && $result) {
            header('Location: showservices.php');
            exit();
        }
    }
}

// Cancel action
if (isset($_POST['bcancel'])) {
    $_SESSION['trans'] = 'cancel';
    header('Location: showservices.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentist Service Form</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<div class="content">
    <form action="#" method="POST">
        <main id="main" class="container">
            <section class="section dashboard">
                <div class="row">
                    <div class="row m-5">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <h2 class="ps-4">Services Form</h2>
                        </div>

                        <div class="col-md-6">
                            <div class="row-md-3">
                                <label class="col-md-3 col-form-label">Service Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="servicename" value="<?php echo htmlspecialchars($servicename); ?>" autofocus>
                                </div>
                            </div>

                            <div class="row-md-3">
                                <label class="col-md-3 col-form-label">Price</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="price" value="<?php echo htmlspecialchars($price); ?>">
                                </div>
                            </div>
                            
                            <!-- Doctor ID Field (if needed) -->
                            <!-- <div class="row-md-3">
                                <label class="col-md-3 col-form-label">Doctor ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="docid" value="<?php echo htmlspecialchars($docid); ?>">
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-success m-3" name="bsave" value="Save">
                            <input type="submit" class="btn btn-danger m-3" name="bcancel" value="Cancel">
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </form>
</div>

</body>
</html>
