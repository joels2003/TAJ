<!DOCTYPE html>
<html>

<head>
    <title>Update Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Update Inventory</h1>
        <form method="post">
            <div class="form-group">
                Parts Name:
                <select name="parts_id" required>
                    <option value="">Select a Part</option>
                    <?php
                    include "connection.php"; // Include your database connection script

                    // Fetch parts from the inventory_table
                    $query = "SELECT parts_id, parts_name FROM inventory_table";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['parts_id'] . '">' . $row['parts_name'] . '</option>';
                        }
                    }
                    mysqli_close($conn);
                    ?>
                </select>
            </div>

            <div class="form-group">
                New Stock: <input type="number" name="new_stock" placeholder="New Stock" required>
            </div>

            <div class="form-group">
                <button type="submit" name="submit">Update Stock</button>
            </div>
        </form>

        <?php
        if (isset($_POST["submit"])) {
            $parts_id = $_POST['parts_id'];
            $new_stock = $_POST['new_stock'];

            include "connection.php"; // Include your database connection script

            // Check if the parts_id exists in the inventory_table
            $query = "SELECT * FROM inventory_table WHERE parts_id = $parts_id";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                // Parts_id exists, update the in_stock value
                $row = mysqli_fetch_assoc($result);
                $current_stock = $row['in_stock'];

                // Calculate the new stock value by adding the current stock and new_stock
                $updated_stock = $current_stock + $new_stock;

                // Update the inventory_table with the new in_stock value
                $updateQuery = "UPDATE inventory_table SET in_stock = '$updated_stock' WHERE parts_id = $parts_id";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    echo "<script>alert('Stock updated successfully');</script>";
                } else {
                    echo "Error updating stock: " . mysqli_error($conn);
                }
            } else {
                echo "Parts ID not found in inventory.";
            }

            mysqli_close($conn);
        }
        ?>
    </div>
</body>

</html>
