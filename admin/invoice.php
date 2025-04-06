<?php
session_start();
include '../class/dataclass.php'; // Database connection file
require '../vendor/autoload.php'; // For PDF generation (TCPDF or DomPDF)

$invoice_id = $_GET['invoice_id'];

// Secure the SQL query using prepared statements
$stmt = $conn->prepare("SELECT * FROM invoices WHERE invoice_id = ?");
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$result = $stmt->get_result();
$invoice = $result->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM invoice_services WHERE invoice_id = ?");
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$services_result = $stmt->get_result();
$services = $services_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Define tax percentage
$tax_percentage = 10; // Change as needed
$subtotal = $invoice['total_amount'];
$tax_amount = ($subtotal * $tax_percentage) / 100;
$total_with_tax = $subtotal + $tax_amount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?php echo htmlspecialchars($invoice['invoice_id']); ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
</head>
<body>
    <div class="invoice-container">
        <h2>Dental Health Care - Invoice</h2>
        <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars($invoice['invoice_id']); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($invoice['date']); ?></p>
        <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($invoice['patient_name']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($invoice['contact']); ?></p>
        
        <table>
            <tr>
                <th>Service</th>
                <th>Price</th>
            </tr>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service['service_name']); ?></td>
                    <td>$<?php echo number_format($service['price'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <h3>Subtotal: $<?php echo number_format($subtotal, 2); ?></h3>
        <h3>Tax (<?php echo $tax_percentage; ?>%): $<?php echo number_format($tax_amount, 2); ?></h3>
        <h3>Total: $<?php echo number_format($total_with_tax, 2); ?></h3>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($invoice['payment_status']); ?></p>
        
        <button onclick="window.print()">Print Invoice</button>
        <a href="generate_pdf.php?invoice_id=<?php echo urlencode($invoice['invoice_id']); ?>">Download PDF</a>
        <a href="send_invoice.php?invoice_id=<?php echo urlencode($invoice['invoice_id']); ?>">Send Email</a>
    </div>
</body>
</html>
