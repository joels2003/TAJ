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
                Vehicle ID: <input type="text" name="vehicle_id" placeholder="Vehicle ID" required>
            </div>

            <!-- <div class="form-group">
                Service ID: <input type="text" name="service_id" placeholder="Service ID"
                    value="<?php echo (isset($serviceId) ? $serviceId : ''); ?>" required readonly>
            </div> -->
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
        
        ?>
    </div>
</body>

</html>