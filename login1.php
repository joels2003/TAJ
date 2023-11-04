<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <form method="POST">
            <center>
                <h1>Login</h1>
            </center><br>
            <div class="form-group">
                <br>
                <center>Username: <input type="text" name="user" placeholder="Username" required></center><br>
            </div>
            <div class="form-group">
                <center>Password: <input type="password" name="pass" placeholder="Password" required></center><br>
            </div>
            <div class="form-group">
                <br>
                <center> Role:
                    <select name="role">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </center><br>
            </div>
            <br>
            <center><button type="submit" name="login">Login</button></center><br>
        </form>
        <?php
        session_start(); // Start the session
        
        if (isset($_REQUEST["login"])) {
            include "connection.php";

            if (!$conn) {
                die("Could not connect: " . mysqli_connect_error());
            }

            $user = $_REQUEST['user'];
            $pass = $_REQUEST['pass'];
            $role = $_REQUEST['role'];

            $sql = "SELECT * FROM login_table WHERE user_id = '$user' AND password = '$pass' AND role='$role'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Store user information in session variables
                $_SESSION['user_id'] = $user;
                $_SESSION['role'] = $role;
                $user_id = $_SESSION['user_id'];
                $role = $_SESSION['role'];

                

                if ($role == "Admin") {
                    header('Location: admin_dashboard.php');
                } elseif ($role == "User") {
                    header('Location: customer_dashboard.php');
                }
            } else {

                echo "<br><center>Invalid Credentials. Try again</center>";
            }
        }
        ?>
    </div>
</body>

</html>