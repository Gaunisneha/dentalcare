<?php
session_start();
require '../vendor/autoload.php';
include '../class/dataclass.php';

$invoice_id = $_GET['invoice_id'];
$invoice = $dc->getrow("SELECT * FROM invoices WHERE invoice_id = $invoice_id");
$services = $dc->gettable("SELECT * FROM invoice_services WHERE invoice_id = $invoice_id");

$tax_percentage = 10;
$subtotal = $invoice['total_amount'];
$tax_amount = $subtotal * $tax_percentage / 100;
$total_with_tax = $subtotal + $tax_amount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice #<?= htmlspecialchars($invoice['invoice_id']) ?></title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="invoice-container">
    <h2>Dental Health Care - Invoice</h2>
    <p><strong>Invoice ID:</strong> <?= htmlspecialchars($invoice['invoice_id']) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($invoice['date']) ?></p>
    <p><strong>Patient Name:</strong> <?= htmlspecialchars($invoice['patient_name']) ?></p>
    <p><strong>Contact:</strong> <?= htmlspecialchars($invoice['contact']) ?></p>

    <table>
      <tr><th>Service</th><th>Price</th></tr>
      <?php foreach ($services as $service): ?>
        <tr>
          <td><?= htmlspecialchars($service['service_name']) ?></td>
          <td>$<?= number_format($service['price'], 2) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <h3>Subtotal: $<?= number_format($subtotal, 2) ?></h3>
    <h3>Tax (<?= $tax_percentage ?>%): $<?= number_format($tax_amount, 2) ?></h3>
    <h3>Total: $<?= number_format($total_with_tax, 2) ?></h3>
    <p><strong>Status:</strong> <?= htmlspecialchars($invoice['payment_status']) ?></p>

    <button onclick="window.print()">Print Invoice</button>
    <a href="generate_pdf.php?invoice_id=<?= urlencode($invoice['invoice_id']) ?>">Download PDF</a>
    <a href="send_invoice.php?invoice_id=<?= urlencode($invoice['invoice_id']) ?>">Send Email</a>
  </div>
</body>
</html>
