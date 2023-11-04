<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Service Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            include "connection.php";
            $VehicleID = $_REQUEST['vehicle_id'];
            $CustomerID = $_REQUEST['user_id'];
            $VehicleName = $_REQUEST['vehiclename'];
            $VehicleModel = $_REQUEST['vehiclemodel'];
            $VehicleRegno = $_REQUEST['vehicleregno'];
            $RegistrationDate = $_REQUEST['registrationdate'];

            // Check if the Customer ID exists in the customer_table
            $checkCustomerSql = "SELECT * FROM customer_table WHERE user_id = '$CustomerID'";
            $checkCustomerResult = mysqli_query($conn, $checkCustomerSql);

            if ($checkCustomerResult) {
                $numRows = mysqli_num_rows($checkCustomerResult);

                if ($numRows > 0) {
                    // Customer ID exists, proceed with insertion
                    $sql = "INSERT INTO vehicle_table (`vehicle_id`, `user_id`, `vehiclename`, `vehiclemodel`, `vehicleregno`, `registrationdate`) 
                    VALUES ('$VehicleID', '$CustomerID', '$VehicleName', '$VehicleModel', '$VehicleRegno', '$RegistrationDate')";

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "<script>alert('Data Inserted Successfully');</script>";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    // Customer ID does not exist, show an error message
                    echo "<script>alert('Customer ID does not exist. Please enter a valid Customer ID.');</script>";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        ?>
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
        <h1>Vehicle Registration</h1>
        <form method="post">
            <div class="form-group">
                Vehicle ID: <input type="text" name="vehicle_id" placeholder="Vehicle ID" required>
            </div>
            <div class="form-group">
                Customer ID: <input type="text" name="user_id" placeholder="Customer ID" required>
            </div>
            <div class="form-group">
                Vehicle Name: <input type="text" name="vehiclename" placeholder="Vehicle Name" required>
            </div>
            <div class="form-group">
                Vehicle Model: <input type="text" name="vehiclemodel" placeholder="Vehicle Model" required>
            </div>
            <div class="form-group">
                Vehicle Registration Number: <input type="text" name="vehicleregno" placeholder="Registration Number" required>
            </div>
            <div class="form-group">
                Registration Date: <input type="datetime-local" name="registrationdate" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
