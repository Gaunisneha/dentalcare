<?php
require 'vendor/autoload.php'; // Include Stripe SDK

\Stripe\Stripe::setApiKey('sk_test_51R6CUcFJ3gZ9x21Ws45uWtxNzANMhhAmlJm9G4bBZhfX4cGvOv5K34vRbS6PDD3wwyLWv1ZcPW49VbYkkSXnhOWo00q7mcHObD'); // Replace with your actual Stripe Secret Key

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $appointment_date = htmlspecialchars($_POST['appointment_date']);
    $amount = htmlspecialchars($_POST['amount']) * 100; 
    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Dental Appointment'],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'success.php',
            'cancel_url' => 'cancel.php',
        ]);

        header("Location: " . $checkout_session->url);
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
