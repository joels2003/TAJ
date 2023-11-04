<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Vehicle Service Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .dashboard {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .widget {
            flex-basis: calc(25% - 20px);
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .widget h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .widget button {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .widget button a {
            text-decoration: none;
            color: #fff;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        /* Added styles for the Logout button */
        .widget.logout {
            position: absolute;
            top: 100px; /* Adjust the bottom position as needed */
            right: 10px; /* Adjust the right position as needed */
        }

        .widget.logout button {
            background-color: red;
        }
    </style>
    <script>
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                // Redirect to the logout page
                window.location.href = "logout.php"; // Change "logout.php" to the actual logout page URL
            }
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard - Vehicle Service Management System</h1>
    </div>

    <div class="container">
        <div class "dashboard">
            <div class="widget">
                <h3>Service Schedule</h3>
                <button><a href="serviceschedule.php">Service Schedules for Vehicles</a></button>
            </div>
            <div class="widget">
                <h3>Customer Registration</h3>
                <button><a href="customercreation.php">Register a Customer</a></button>
            </div>
            <div class="widget">
                <h3>Already Registered Customers</h3>
                <button><a href="list_customer.php">View Customer Details</a></button>
            </div>
            <div class="widget">
                <h3>Vehicle Registration</h3>
                <button><a href="vehicleregister.php">Register Vehicle Details</a></button>
            </div>
            <div class="widget">
                <h3>Service History</h3>
                <button><a href="service_history.php"> History</a></button>
            </div>
            <div class="widget">
                <h3>Inventory</h3>
                <button><a href="inventory.php">Manage Report</a></button>
            </div>
        </div>
    </div>

    <!-- Logout button at the right bottom but above the footer -->
    <div class="widget logout">
        <button onclick="logout()">Logout</button>
    </div>

    <div class="footer">
        <p>&copy; 2023 Admin Dashboard - Vehicle Service Management System. All rights reserved.</p>
    </div>
</body>
</html>
