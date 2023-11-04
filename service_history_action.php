<?php
// Include your database connection
include("connection.php");

// Initialize variables
$user_id = $_POST['user_id'];
$vehicle_id = $_POST['vehicle_id'];

// Fetch data from the customer_table
$customerQuery = "SELECT firstname, lastname, contactnumber FROM customer_table WHERE user_id = ?";
$customerStatement = $conn->prepare($customerQuery);
$customerStatement->bind_param('s', $user_id);
$customerStatement->execute();
$customerStatement->bind_result($firstname, $lastname, $contactnumber);

if ($customerStatement->fetch()) {
    $customerStatement->close();

    // Fetch data from the service_table
    $serviceQuery = "SELECT vehicle_id, service_id, pickupdate, deliverydate, bill_amount FROM service_table WHERE vehicle_id = ?";
    $serviceStatement = $conn->prepare($serviceQuery);
    $serviceStatement->bind_param('s', $vehicle_id);
    $serviceStatement->execute();
    $serviceStatement->bind_result($service_vehicle_id, $service_id, $pickupdate, $deliverydate, $bill_amount);

    if ($serviceStatement->fetch()) {
        $serviceStatement->close();

        // Fetch data from the vehicle_table
        $vehicleQuery = "SELECT vehiclename, vehiclemodel, vehicleregno FROM vehicle_table WHERE user_id = ? AND vehicle_id = ?";
        $vehicleStatement = $conn->prepare($vehicleQuery);
        $vehicleStatement->bind_param('ss', $user_id, $vehicle_id);
        $vehicleStatement->execute();
        $vehicleStatement->bind_result($vehiclename, $vehiclemodel, $vehicleregno);

        if ($vehicleStatement->fetch()) {
            $vehicleStatement->close();
            // Display the data
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Service History</title>
                <link rel="stylesheet" type="text/css" href="style.css"> <!-- Include your CSS file if needed -->
                <style>
                /* Apply styles to the <a> element */
a.button {
    display: inline-block;
    padding: 10px 20px; /* Adjust padding as needed for button size */
    background-color: #007BFF; /* Button background color */
    color: #fff; /* Text color */
    text-decoration: none; /* Remove underline by default */
    border: none; /* Remove border */
    border-radius: 4px; /* Rounded corners */
    font-weight: bold; /* Make text bold */
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Add a smooth transition on hover */
}

/* Style the button on hover */
a.button:hover {
    background-color: #0056b3; /* Change background color on hover */
}

/* You can add more styles as needed, such as margin, box-shadow, etc. */

                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Service History</h1>
                    <div class="result">
                        <h2>Customer Details</h2>
                        <p>Name: ' . $firstname . ' ' . $lastname . '</p>
                        <p>Contact Number: ' . $contactnumber . '</p>
                        
                        <h2>Vehicle Details</h2>
                        <p>Vehicle Name: ' . $vehiclename . '</p>
                        <p>Vehicle Model: ' . $vehiclemodel . '</p>
                        <p>Vehicle Registration Number: ' . $vehicleregno . '</p>
                        
                        <h2>Service Details</h2>
                        <p>Vehicle ID: ' . $service_vehicle_id . '</p>
                        <p>Service ID: ' . $service_id . '</p>
                        <p>Pickup Date: ' . $pickupdate . '</p>
                        <p>Delivery Date: ' . $deliverydate . '</p>
                        <p>Bill Amount: ' . $bill_amount . '</p>

                        <a href="service_history.php" class="button">Back</a>

                    </div>
                </div>
            </body>
            </html>';
        } else {
            echo "Vehicle details not found.";
        }
    } else {
        echo "Service details not found.";
    }
} else {
    echo "Customer details not found.";
}

$conn->close();
?>