<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <link rel="stylesheet" type="text/css" href="list_customer_style.css">
</head>
<body>
    <div class="header">
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
        <h2>Customer List</h2>
    </div>

    <?php
    // Include the connection.php file
    include "connection.php";

    // Query to retrieve all customer data from the customer_table
    $query = "SELECT user_id, firstname, lastname, contactnumber, email, customer_address FROM customer_table";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if there are any customers
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Contact Number</th><th>Email</th><th>Customer Address</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['contactnumber'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['customer_address'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No customers found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
