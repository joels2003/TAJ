<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Service Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <a href="admin_dashboard.php">Back to Dashboard</a>
        <h1>Customer Account Creation</h1>
        <form method="post">
            <div class="form-group">
                User ID: <input type="text" name="user_id" placeholder="User ID" required>
            </div>
            <div class="form-group">
                Password: <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                First Name: <input type="text" name="firstname" placeholder="First Name" required>
            </div>
            <div class="form-group">
                Last Name: <input type="text" name="lastname" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                Contact Number: <input type="tel" name="contactnumber" placeholder="Contact Number" required>
            </div>
            <div class="form-group">
                Email: <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                Customer Address: <input type="text" name="customer_address" placeholder="Customer Address" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Create Account</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        include "connection.php";
        if (!$conn) {
            die("Could not connect: " . mysqli_connect_error());
        }

        $user_id = $_POST['user_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $contactnumber = $_POST['contactnumber'];
        $email = $_POST['email'];
        $customer_address = $_POST['customer_address'];
        $password = $_POST['password'];
        $role = "User";

        // Insert login data into login_table using prepared statement
        $stmt = $conn->prepare("INSERT INTO login_table (user_id, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_id, $password, $role);

        // Insert customer data into customer_table
        $sql = "INSERT INTO customer_table (user_id, firstname, lastname, contactnumber, email, customer_address)
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("ssssss", $user_id, $firstname, $lastname, $contactnumber, $email, $customer_address);

        if ($stmt->execute() && $stmt2->execute()) {
            echo "<script>alert('Customer Registered Successfully');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statements and the database connection
        $stmt->close();
        $stmt2->close();
        $conn->close();
    }
    ?>
</body>
</html>
