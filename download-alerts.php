<?php
// download-alerts.php
// Password-protected CSV download for Shay
// Usage: https://yourdomain.com/download-alerts.php?key=PoshRocks2026

$password = "PoshRocks2026"; // Change this to something only Shay knows

if (!isset($_GET["key"]) || $_GET["key"] !== $password) {
    http_response_code(403);
    die("Access denied.");
}

$csv_file = __DIR__ . "/data/sale_alerts.csv";

if (!file_exists($csv_file)) {
    die("No signups yet -- check back soon!");
}

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=shay_sale_alerts_" . date("Y-m-d") . ".csv");
readfile($csv_file);
exit;
?>
