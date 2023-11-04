<!DOCTYPE html>
<html>

<head>
    <title>Inventory Management</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // JavaScript function to update the price based on selected items
        function updatePrice() {
            var selectedItems = document.querySelectorAll('input[name="parts_name[]"]:checked');
            var totalPrice = 0;

            selectedItems.forEach(function (item) {
                totalPrice += parseFloat(item.getAttribute('data-price'));
            });

            document.getElementById('price').value = totalPrice; // Update the price field with the calculated total
        }
    </script>
</head>

<body>
    <div class="container">
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
        <h1>Add Inventory Item</h1>
        <form method="post" action="pdf.php">
            <div class="form-group">
                Service ID: <input type="text" name="service_id" placeholder="Service ID" value="<?php echo generateServiceID(); ?>" required readonly>
            </div>

            <div class="form-group">
                Vehicle ID: <input type="text" name="vehicle_id" placeholder="Vehicle ID" required>
            </div>

            <div class="form-group">
                Parts (Select Multiple):
                <?php
                include "connection.php";
                session_start();
              // echo "user : ". $user_id = $_SESSION["user_id"];
                if (!$conn) {
                    die("Could not connect: " . mysqli_connect_error());
                }
                $query = "SELECT parts_id, parts_name, price FROM inventory_table";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<label><input type="checkbox" name="parts_name[]" value="' . $row['parts_id'] . '" data-price="' . $row['price'] . '" onchange="updatePrice()"> ' . $row['parts_name'] . '</label><br>';
                    }
                }
                mysqli_close($conn);
                ?>
            </div>
            <div class="form-group">
                Total Price: <input type="number" id="price" name="price" placeholder="Total Price" required readonly>
            </div>

            <div class="form-group">
                <button type="submit" name="bill">Report</button>
            </div>
        </form>
        <?php
        // Function to generate a unique alphanumeric service ID
        function generateServiceID() {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $service_id = '';
            for ($i = 0; $i < 8; $i++) {
                $service_id .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $service_id;
        }

        if (isset($_POST["submit"])) {
            include "connection.php";
            if (!$conn) {
                die("Could not connect: " . mysqli_connect_error());
            }

            $service_id = $_POST['service_id'];
            $vehicle_id = $_POST['vehicle_id'];

            // Calculate the total price based on the selected parts
            $total_price = 0;
            foreach ($_POST['parts_name'] as $part_id) {
                $part_id = (int)$part_id;
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
            $sql = "INSERT INTO service_table (service_id, vehicle_id, bill_amount)
                    VALUES ('$service_id', '$vehicle_id', '$total_price')";
            $updateResult = mysqli_query($conn, $sql);

            if ($result && $updateResult) {
                echo "<script>alert('Inventory Item Added Successfully');</script>";
            } else {
                echo " " . mysqli_error($conn);
                echo "<script>alert('Data Inserted Successfully');</script>";
            }
        }
        ?>
    </div>
</body>

</html>
