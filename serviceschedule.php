<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Service Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
        <h1>Create Service Schedule</h1>
        <form method="post">
            <!div class="form-group">
                <!input type="text" name="service_id" placeholder="Service ID" required>
            <!/div>
            <div class="form-group">
                Vehicle ID: <input type="text" name="vehicle_id" placeholder="Vehicle ID" required>
            </div>
            <div class="form-group">
                Pick-up Date: <input type="date" name="pickupdate" required>
            </div>
            <div class="form-group">
                Delivery Date: <input type="date" name="deliverydate" required>
            </div>
            <!-- Bill Amount: <input type="number" name="bill_amount" placeholder="Bill Amount" required> -->
            <div class="form-group">
                <button type="submit" name="submit">Create Schedule</button>
            </div>
        </form>
        <?php
        if (isset($_POST["submit"])) {
            include "connection.php";
            if (!$conn) {
                die("Could not connect: " . mysqli_connect_error());
            }

            $vehicle_id = $_POST['vehicle_id'];
            $pickupdate = $_POST['pickupdate'];
            $deliverydate = $_POST['deliverydate'];
            // $bill_amount = $_POST['bill_amount'];
           // $service_id = $_POST['service_id'];
           
           function generateServiceID() {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $service_id = '';
            for ($i = 0; $i < 8; $i++) {
                $service_id .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $service_id;
        }
        $service_id = generateServiceID(); 
            // Insert service schedule data into service_table
            $sql = "INSERT INTO service_table (service_id, vehicle_id, pickupdate, deliverydate, bill_amount)
                    VALUES ('$service_id', '$vehicle_id', '$pickupdate', '$deliverydate', 0)"; // Set bill_amount to 0 for now
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('Service Schedule Created Successfully');</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        ?>
    </div>
</body>
</html>
