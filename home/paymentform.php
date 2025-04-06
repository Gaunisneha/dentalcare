<?php
// session_start(); // Ensure session starts before output

include('header.php');
include('csslink.php');
include('../class/DataClass.php');

$dc = new DataClass();
$msg = "";

// // Check session validity
// if (!isset($_SESSION['regid'], $_SESSION['username'], $_SESSION['price'])) {
//     echo "<script>alert('Session expired. Please log in again.'); window.location='login.php';</script>";
//     exit();
// }

$regid = $_SESSION['regid'];
$username = $_SESSION['username'];
$amount = $_SESSION['price'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment'])) {
    $paydate = date("Y-m-d H:i:s");
    $appid = trim($_POST['appid'] ?? '');  
    $paymode = trim($_POST['paymode'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $payment_done = isset($_POST['payment_done']) ? "Completed" : "Pending";

    if (empty($paymode) || empty($amount)) {
        echo "<script>alert('Missing required fields. Please try again.');</script>";
    } else {
        $query = "INSERT INTO payment (paydate, regid, appid, paytype, amount, status) 
                  VALUES ('$paydate', '$regid', '$appid', '$paymode', '$amount', '$payment_done')";

        $result = $dc->insertrecord($query);

        if ($result) {
            if ($paymode == "UPI" && $payment_done == "Pending") {
                echo "<script>alert('Please complete the UPI payment.');</script>";
            } else {
                echo "<script>alert('Payment successful! Redirecting to Bill page.'); window.location='appointment_confirmation.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Payment failed. Please try again.');</script>";
        }
    }
}
?>
<?php    
        if(isset($_POST['bexit']))
        {
            $_SESSION['trans']='exit';
            header ('location:appointment_confirmation.php');
        
        }

       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("paydate").value = new Date().toISOString().split('T')[0];
        togglePaymentSections(); // Ensure correct initial state
    });

    function togglePaymentSections() {
        let payMode = document.getElementById("paymode").value;
        let qrSection = document.getElementById("upiQR");
        let cashMessage = document.getElementById("cashMessage");
        let paymentDoneSection = document.getElementById("paymentDoneSection");

        if (payMode === "UPI") {
            qrSection.style.display = "block";
            paymentDoneSection.style.display = "block";
        } else {
            qrSection.style.display = "none";
            paymentDoneSection.style.display = "none";
        }

        cashMessage.style.display = (payMode === "Cash") ? "block" : "none";
    }

    function hideQR() {
    let qrSection = document.getElementById("upiQR");
    let checkbox = document.getElementById("payment_done");
    let paymentPhpSection = document.getElementById("paymentPhpSection");

    if (checkbox.checked) {
        qrSection.style.display = "none";
        paymentPhpSection.style.display = "none"; // Hide included payment.php
    } else {
        qrSection.style.display = "block";
        paymentPhpSection.style.display = "block"; // Show included payment.php
    }
}
    </script>
    
</head>
<body>
    
    <form method="post">
        <div class="container">
            <h2>Payment</h2>
            
            <label>Pay Date</label>
            <input type="date" name="paydate" id="paydate" class="form-control" readonly />
            
           
            
            <label>Pay Mode</label>
            <select name="paymode" id="paymode" class="form-control" onchange="togglePaymentSections()">
                <option value="">Select Payment Mode</option>
                <option value="UPI">UPI</option>
                <option value="Cash">Cash</option>
            </select>
            
            <label>Amount</label>
            <input type="text" name="amount" class="form-control" value="<?php echo $amount ?>" readonly />
            
            <!-- QR Code Section -->
            <div id="upiQR" style="display:none; text-align:center; margin-top:10px;">
                <h4>Scan QR to Pay</h4>

           

           
            <div id="paymentDoneSection" style="display:none; text-align:center; margin-top:10px;">
                
                <div id="paymentPhpSection">
                    <?php include('payment.php'); ?>
                </div>
                <label>
                    <input type="checkbox" name="payment_done" id="payment_done" onclick="hideQR()"> I have completed the UPI payment
                </label>x
            </div>
</div>



            <!-- Cash Message -->
            <div id="cashMessage" style="display:none; text-align:center; margin-top:10px; color: green;">
                <h4>Please pay in cash at the counter.</h4>
            </div>
            
            <div style="margin-top:10px">
                <input type="submit" class="btn btn-primary" name="payment" value="Proceed to Payment">
                <input type="submit" class="btn btn-primary" name="bexit" value="Cancel">

            </div>
        </div>
    </form>
</body>
</html>
