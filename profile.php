<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="profile_style.css"> <!-- Link to your external CSS file -->
    <title>My Profile</title>
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
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <h1>My Profile</h1>
        <?php
        session_start();
        include("connection.php");
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM customer_table WHERE user_id = '$user_id'"; // Wrap user_id in single quotes

        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch the row
        ?>
            <!-- Display the profile details in a table -->
            <table>
                <tr>
                    <th>User ID</th>
                    <td><?php echo $row["user_id"]; ?></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><?php echo $row["firstname"]; ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo $row["lastname"]; ?></td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td><?php echo $row["contactnumber"]; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $row["email"]; ?></td>
                </tr>
                <tr>
                    <th>Customer Address</th>
                    <td><?php echo $row["customer_address"]; ?></td>
                </tr>
            </table>
        <?php
        } else {
            echo "User not found.";
        }

        $conn->close();
        ?>

        <!-- Add a Back Button to the right-bottom corner -->
        <button class="back-button" onclick="goBack()">Back</button>
    </div>

    <script>
        // JavaScript function to go back to the previous page or user dashboard
        function goBack() {
            window.history.back(); // This will take the user to the previous page
        }
    </script>
</body>
</html>
