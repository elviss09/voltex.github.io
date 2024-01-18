<?php
require_once 'config.php';
require_once 'stripe-php-10.3.0/init.php';
require_once __DIR__ . '/vendor/autoload.php';
include ('connect-server.php');

$stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);

// After the payment is successful
if (isset($_GET['provider_session_id'])) {
    // Store payment details into the payment record database
    $provider_session_id = $_GET['provider_session_id'];

    // Retrieve payment details from the Stripe API using the session ID
    $checkoutSession = $stripe->checkout->sessions->retrieve($provider_session_id);

    // Extract relevant payment information
    $payment_id = $checkoutSession->payment_intent;
    $total_paid = $checkoutSession->amount_total / 100; // Convert from cents to the currency

    // Get the current date and time
    $payment_date = date("Y-m-d H:i:s");

    // Insert payment details into the payment_record table
    $insert_payment = mysqli_query($conn, "INSERT INTO `payment_record` (payment_id, total_paid, payment_date) VALUES ('$payment_id', '$total_paid', '$payment_date')") or die(mysqli_error($conn));

    if ($insert_payment) {
        // Update services_record table with payment_id
        $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
        $update_service_record = mysqli_query($conn, "UPDATE `services_record` SET payment_id = '$payment_id' WHERE service_id = '$service_id'") or die(mysqli_error($conn));

        if ($update_service_record) {
            // Display success message to the user
            echo "Payment successful! Redirecting to the home page...";

            // Redirect to the index page after a few seconds
            header('Location: http://localhost/Voltex/index.php');
            exit;
        } else {
            // Handle the case where the update failed
            echo "Payment successful, but failed to update service record. Please contact support.";
        }
    } else {
        // Handle the case where the insertion failed
        echo "Payment successful, but failed to store payment details. Please contact support.";
    }
}
?>