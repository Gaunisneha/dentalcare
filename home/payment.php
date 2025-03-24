<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Payment</title>
    <link rel="stylesheet" href="./css/payment.css">
    <link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-calendar-check"></i> Book an Appointment</h2>
        <form action="checkout.php" method="POST">
            
            <div class="input-group">
                <input type="text" name="name" placeholder="Full Name" required>
                <i class="fas fa-user"></i>
            </div>

            <div class="input-group">
                <input type="email" name="email" placeholder="Email Address" required>
                <i class="fas fa-envelope"></i>
            </div>

            <div class="input-group">
                <input type="text" name="phone" placeholder="Phone Number" required>
                <i class="fas fa-phone"></i>
            </div>

            <div class="input-group">
                <input type="date" name="appointment_date" required>
            </div>

            <div class="input-group">
                <input type="number" name="amount" placeholder="Amount ($)" required>
                <i class="fas fa-rupee-sign"></i>
            </div>

            <button type="submit"><i class="fas fa-credit-card"></i> Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
