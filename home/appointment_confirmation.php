<?php
session_start(); // Start session
include("csslink.php");
include ("../class/dataclass.php");
    $dc=new dataclass();
if (!isset($_SESSION['appointment_details']) || empty($_SESSION['appointment_details'])) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'No Appointment Found',
                text: 'You do not have any scheduled appointment.',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='appointment.php';
                }
            });
          </script>";
    exit();
}




// Ensure session data is an array, not a mysqli_result
if ($_SESSION['appointment_details'] instanceof mysqli_result) {
    $appointment = $_SESSION['appointment_details']->fetch_assoc(); // Convert result to an associative array
} elseif (is_array($_SESSION['appointment_details'])) {
    $appointment = $_SESSION['appointment_details'];
} else {
    $appointment = []; // Set an empty array if data is invalid
}
// Validate that appointment data is correctly structured
if (!is_array($appointment) || empty($appointment)) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Appointment Data',
                text: 'There was an issue retrieving your appointment details.',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='appointment.php';
                }
            });
          </script>";
    exit();
}
$query="SELECT appid FROM `appointment` ORDER BY appid DESC LIMIT 1";
$rw=$dc->getrow($query);

$id=$rw['appid'];
    
$_SESSION["price"]=$appointment['price'];

$q="SELECT * FROM `appointment` where appid=$id";
$r=$dc->getrow($q);
$did=$r["docid"];
// echo $r['status'];;
$_SESSION['status']=$r["status"];

$qe="select * from  dentist where docid=$did";
$re=$dc->getrow($qe);
$_SESSION['dname']=$re['docname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Add Bootstrap CSS if required -->
</head>
<body>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-success">Appointment Confirmed</h2>
        <p class="text-center">Your appointment has been successfully approved.</p>
        
        <table class="table table-bordered mt-3">
            <tr>
                <th>Patient Name</th>
                <td><?php echo htmlspecialchars(strval($appointment['patientname'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars(strval($appointment['emailid'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Doctor</th>
                <td><?php echo htmlspecialchars(strval($appointment['docid'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Service</th>
                <td><?php echo htmlspecialchars(strval($appointment['service'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Appointment Date</th>
                <td><?php echo htmlspecialchars(strval($appointment['appdate'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Appointment Time</th>
                <td><?php echo htmlspecialchars(strval($appointment['apptime'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td>₹<?php echo htmlspecialchars(strval($appointment['price'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td><?php echo htmlspecialchars(strval($appointment['remark'] ?? 'N/A')); ?></td>
            </tr>
        </table>

        <div class="text-center mt-3">
    <a href="mainhome.php" class="btn btn-primary">Back to Home</a>

    <?php if (!empty($r) && isset($r['status']) && $r['status'] === 'Active') : ?>
        <a href="paymentform.php" class="btn btn-primary">Payment</a>
    <?php else : ?>
        <button class="btn btn-secondary" disabled>Payment (Pending)</button>
    <?php endif; ?>

    <a href="generatedbill.php" class="btn btn-success">Generate Bill</a>
</div>


    </div>
</div>

<?php include("footer.php"); ?>
<?php include("jsslink.php"); ?>

</body>
</html>
