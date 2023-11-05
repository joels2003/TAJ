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






if (!$conn) {
    die("Could not connect: " . mysqli_connect_error());
}

//  $service_id = $_POST['service_id'];
// $vehicle_id = $_POST['vehicle_id'];
// $vehicle_id = $_POST['vehicle_id'];

// Fetch the service_id based on the provided vehicle_id
$sql = "SELECT service_id FROM service_table WHERE vehicle_id = '$vehicle_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $serviceId = $row['service_id'];
    } else {
        echo "<script>
            // Show the alert box
            alert('No matching Vehicle ID found in the database. Please check the Vehicle ID.');
        
          
            window.location.href = 'inventory.php';
        </script>
        ";
    }
} else {
    echo "<script>alert('Error fetching data: " . mysqli_error($conn) . "');</script>";
}


// Calculate the total price based on the selected parts
$total_price = 0;
foreach ($_POST['parts_name'] as $part_id) {
    $part_id = (int) $part_id;
    $query = "SELECT price FROM inventory_table WHERE parts_id = $part_id";
    $result = mysqli_query($conn, $query);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $total_price += $row['price'];
    }
}

// Insert inventory item data into inventory_table
$parts_name = implode(", ", $_POST['parts_name']);
$sql = "INSERT INTO inventory_table (service_id, vehicle_id, parts_name, price)
            VALUES ('$service_id', '$vehicle_id', '$parts_name', '$total_price')";
$result = mysqli_query($conn, $sql);

// Update the service table's bill_amount with the calculated total price


$sql = "UPDATE service_table
    SET bill_amount = $total_price
    WHERE vehicle_id = $vehicle_id";
$updateResult = mysqli_query($conn, $sql);

if ($result && $updateResult) {
    echo "<script>alert('Inventory Item Added Successfully');</script>";
} else {
    echo " " . mysqli_error($conn);
    echo "<script>alert('Vehicle Id Not found');</script>";
}





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