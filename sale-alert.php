<?php
// sale-alert.php
// Handles form POST: emails Shay, confirms to customer, logs CSV

$shay_email = "shayitwithposh@mail.com";
$csv_file   = __DIR__ . "/data/sale_alerts.csv";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer_email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $products       = isset($_POST["products"]) ? (array)$_POST["products"] : [];
    $products_str   = implode(" | ", array_map("htmlspecialchars", $products));
    $date           = date("Y-m-d H:i:s");

    if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL) || empty($products)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Please enter a valid email and select at least one product."]);
        exit;
    }

    // 1. Append to CSV
    if (!file_exists(dirname($csv_file))) {
        mkdir(dirname($csv_file), 0755, true);
    }
    $new_file = !file_exists($csv_file);
    $fh = fopen($csv_file, "a");
    if ($new_file) {
        fputcsv($fh, ["Date", "Customer Email", "Products"]);
    }
    fputcsv($fh, [$date, $customer_email, $products_str]);
    fclose($fh);

    // 2. Email Shay
    $subject = "New Sale Alert Signup -- $products_str";
    $body    = "Hi Shay!\n\n"
             . "Someone just signed up for sale alerts on your Posh site:\n\n"
             . "Email:    $customer_email\n"
             . "Products: $products_str\n"
             . "Date:     $date\n\n"
             . "Download your full list anytime:\n"
             . "https://yourdomain.com/download-alerts.php?key=PoshRocks2026\n\n"
             . "-- Your Posh Site";
    $headers = "From: noreply@yourdomain.com\r\nReply-To: $customer_email";
    mail($shay_email, $subject, $body, $headers);

    // 3. Confirmation email to customer
    $c_subject = "You're on Shay's Sale Alert List!";
    $c_body    = "Hi there!\n\n"
               . "You're all signed up! Shay will personally email you when the following "
               . "Perfectly Posh products go on sale:\n\n"
               . $products_str . "\n\n"
               . "In the meantime, shop Shay's Posh store anytime:\n"
               . "https://perfectlyposh.com/shayhewitt\n\n"
               . "Questions? Just reply to this email.\n\n"
               . "-- Shay Hewitt\n"
               . "Independent Perfectly Posh Advocate\n"
               . "shayitwithposh@mail.com";
    $c_headers = "From: shayitwithposh@mail.com\r\nReply-To: shayitwithposh@mail.com";
    mail($customer_email, $c_subject, $c_body, $c_headers);

    echo json_encode(["success" => true, "message" => "You're on the list! Watch your inbox for a confirmation from Shay."]);
    exit;
}
?>
