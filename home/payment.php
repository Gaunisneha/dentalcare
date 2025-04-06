<?php
// session_start();

// UPI Payment Details
$upi_id = "manasiyamosinali1-1@oksbi";  
$name = "mosinali";  
$amount = number_format((float) $_SESSION['price'], 2, '.', ''); 
$currency = "INR"; 
$aid = "uGICAgMDcgcajQQ";  

// Generate UPI Payment Link
$upi_link = "upi://pay?pa=$upi_id&pn=" . urlencode($name) . "&am=" . urlencode($amount) . "&cu=" . urlencode($currency) . "&aid=" . urlencode($aid);

// Generate QR Code
$qr_code_url = "https://quickchart.io/qr?text=" . urlencode($upi_link) . "&size=250";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPI Payment</title>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body { font-family: Arial, sans-serif; background: #e9ecef; }
        .container { max-width: 500px; margin-top: 50px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .btn-upi { background: rgb(23, 197, 255); color: white; font-weight: bold; padding: 12px 20px; border: none; border-radius: 5px; transition: background 0.3s; width: 100%; }
        .btn-upi:hover { background: rgb(18, 161, 217); }
        .qr-code { text-align: center; margin-top: 20px; }
        .timer { font-size: 20px; font-weight: bold; color: red; text-align: center; margin-bottom: 15px; }
        .a{ background-color:blue;}
        
    </style>

    <script>
        let timeLeft = 300;  // 5 minutes countdown (300 seconds)

        function startTimer() {
            let timerInterval = setInterval(function() {
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                document.getElementById("countdown").innerText = minutes + ":" + seconds;

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    window.location.href = "appointment.php";  // Redirect after 5 minutes
                }
                timeLeft--;
            }, 1000);
        }
    </script>
</head>
<body onload="startTimer()" >

    <div class="container text-center">
        <h2 class="mb-3">Complete Your Payment</h2>

        <!-- Timer -->
        <div class="timer">Time Left: <span id="countdown">5:00</span></div>

        <!-- UPI Payment Link -->
        <a href="<?= htmlspecialchars($upi_link); ?>" class="btn-upi d-block text-center mb-3">
            Pay ₹<?php echo htmlspecialchars($amount); ?> via UPI
        </a>

        <!-- QR Code -->
        <div class="qr-code">
            <p>Or scan the QR code:</p>
            <img src="<?= htmlspecialchars($qr_code_url); ?>" alt="UPI QR Code">
        </div>
        
    </div>

</body>
</html>
