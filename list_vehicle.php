<!DOCTYPE html>
<html>
<head>
    <title>Vehicle List</title>
    <link rel="stylesheet" type="text/css" href="list_vehicle_style.css">
</head>
<body>
    <div class="container">
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
        <h2>Vehicle List</h2>
    </div>

    <?php
    // Include the connection.php file
    include "connection.php";

    // Query to retrieve all vehicle data from the vehicle_table
    $query = "SELECT * FROM vehicle_table";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if there are any vehicles
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Vehicle ID</th><th>User ID</th><th>Vehicle Name</th><th>Model</th><th>Vehicle Registration No</th><th>Registration Date</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['vehicle_id'] . "</td>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['vehiclename'] . "</td>";
            echo "<td>" . $row['vehiclemodel'] . "</td>";
            echo "<td>" . $row['vehicleregno'] . "</td>";
            echo "<td>" . $row['registrationdate'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No vehicles found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
