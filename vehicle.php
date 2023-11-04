<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="profile_style.css"> <!-- Link to your external CSS file -->
    <title>Vehicle Details</title>
    <style>
        /* CSS for aligning the back button to the right-bottom corner */
        .profile-container {
            position: relative;
        }

        .back-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        /* CSS for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
        button[type="submit"] {
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <h1>Vehicle Details</h1>
        <?php
        session_start();
        include("connection.php");
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM vehicle_table WHERE user_id = '$user_id'"; // Wrap user_id in single quotes

        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch the row
        ?>
            <!-- Display the vehicle details in a table -->
            <table>
                <tr>
                    <th>User Name</th>
                    <td><?php echo $user_id; ?></td>
                </tr>
                <tr>
                    <th>Vehicle ID</th>
                    <td><?php echo $row["vehicle_id"]; ?></td>
                </tr>
                <tr>
                    <th>Vehicle Name</th>
                    <td><?php echo $row["vehiclename"]; ?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?php echo $row["vehiclemodel"]; ?></td>
                </tr>
                <tr>
                    <th>Registration No</th>
                    <td><?php echo $row["vehicleregno"]; ?></td>
                </tr>
                <tr>
                    <th>Date of Registration</th>
                    <td><?php echo $row["registrationdate"]; ?></td>
                </tr>
            </table>
            <center>
                <form action="pdf_customer.php" method="post">
                <button type="submit" name="bill">Print Bill</button>
                </form>
            </center>
        <?php
        } else {
            echo "Vehicle not found.";
        }

        $conn->close();
        ?>

        <!-- Add a Back Button to the right-bottom corner -->
        <button class="back-button" onclick="goBack()">Back</button>

        <script>
            // JavaScript function to go back to the previous page
            function goBack() {
                window.history.back();
            }
        </script>
    </div>
</body>
</html>