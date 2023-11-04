<?php
// Include the mPDF library
require_once __DIR__ . '/vendor/autoload.php';

// Initialize mPDF object
$mpdf = new \Mpdf\Mpdf();

// Fetch data from the database
include "connection.php";

// Define the selected vehicle ID and get other relevant data
$vehicle_id = $_POST['vehicle_id'];
session_start();
$user_id = $_SESSION['user_id'];

// Fetch vehicle information from the "vehicle_table"
$vehicleQuery = "SELECT vehiclename, vehicleregno, user_id FROM vehicle_table WHERE vehicle_id = '$vehicle_id'";
$vehicleResult = $conn->query($vehicleQuery);
$vehicleData = $vehicleResult->fetch_assoc();

$user = $vehicleData['user_id'];

// Fetch customer information from the "customer_table"
$customerQuery = "SELECT firstname, lastname, contactnumber FROM customer_table WHERE user_id = '$user'";
$customerResult = $conn->query($customerQuery);
$customerData = $customerResult->fetch_assoc();

// Fetch selected parts and their prices from the "inventory_table"
$selectedParts = $_POST['parts_name'];
$partsQuery = "SELECT parts_name, price FROM inventory_table WHERE parts_id IN (" . implode(",", $selectedParts) . ")";
$partsResult = $conn->query($partsQuery);

$partsData = array();
while ($row = $partsResult->fetch_assoc()) {
    $partsData[] = $row;
}

// Calculate the total price
$totalPrice = 0;
foreach ($partsData as $part) {
    $totalPrice += $part['price'];
}

// Generate the HTML content for the bill
$html = "<h1>Invoice</h1>";
$html .= "<p>Customer: {$customerData['firstname']} {$customerData['lastname']}</p>";
$html .= "<p>Contact Number: {$customerData['contactnumber']}</p>";
$html .= "<p>Vehicle Name: {$vehicleData['vehiclename']}</p>";
$html .= "<p>Vehicle Registration Number: {$vehicleData['vehicleregno']}</p>";
$html .= "<h2>Selected Parts:</h2>";

foreach ($partsData as $part) {
    $html .= "<p>{$part['parts_name']}: {$part['price']} RS</p>";
}

$html .= "<h2>Total Amount:RS $totalPrice </h2>";

// Write the HTML content to mPDF
$mpdf->WriteHTML($html);

// Get the PDF content as a string
$pdfContent = $mpdf->Output('', 'S');

// Insert the PDF content into the 'service_table' in the 'reciept' field
$recieptQuery = "UPDATE service_table SET reciept = ? WHERE vehicle_id = ?";
$recieptStatement = $conn->prepare($recieptQuery);
$recieptStatement->bind_param('si', $pdfContent, $vehicle_id);

if ($recieptStatement->execute()) {
    echo "PDF generated and inserted into the database successfully.";

    $mpdf->Output('bill.pdf', 'D');
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
