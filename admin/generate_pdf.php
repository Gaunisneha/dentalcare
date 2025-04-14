<?php
require '../vendor/autoload.php';
include '../class/dataclass.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$invoice_id = $_GET['invoice_id'];
$invoice = $dc->getrow("SELECT * FROM invoices WHERE invoice_id = $invoice_id");
$services = $dc->gettable("SELECT * FROM invoice_services WHERE invoice_id = $invoice_id");

$tax_percentage = 10;
$subtotal = $invoice['total_amount'];
$tax_amount = $subtotal * $tax_percentage / 100;
$total_with_tax = $subtotal + $tax_amount;

$html = '
<h2 style="text-align:center;">Dental Health Care - Invoice</h2>
<p><strong>Invoice ID:</strong> ' . $invoice['invoice_id'] . '</p>
<p><strong>Date:</strong> ' . $invoice['date'] . '</p>
<p><strong>Patient Name:</strong> ' . $invoice['patient_name'] . '</p>
<p><strong>Contact:</strong> ' . $invoice['contact'] . '</p>

<table style="width:100%; border-collapse:collapse;" border="1" cellpadding="8">
<tr><th>Service</th><th>Price</th></tr>';

foreach ($services as $service) {
    $html .= '<tr>
        <td>' . $service['service_name'] . '</td>
        <td>$' . number_format($service['price'], 2) . '</td>
    </tr>';
}

$html .= '</table>

<h3>Subtotal: $' . number_format($subtotal, 2) . '</h3>
<h3>Tax (' . $tax_percentage . '%): $' . number_format($tax_amount, 2) . '</h3>
<h3>Total: $' . number_format($total_with_tax, 2) . '</h3>
<p><strong>Status:</strong> ' . $invoice['payment_status'] . '</p>';

$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream("Invoice_" . $invoice_id . ".pdf", ["Attachment" => true]);
?>
