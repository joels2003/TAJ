<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Service Management System</title>
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

        .hero {
            text-align: center;
            padding: 100px 0;
            background-color: #f9f9f9;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .services {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .service {
            flex-basis: calc(33.33% - 20px);
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .service h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        /* CSS styles for the logout button */
        .logout-button {
            background-color: #f44336;
            color: white;
            border: none;
            height: 40px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Style the icon inside the button */
        .logout-button i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Vehicle Service Management System</h1>
    </div>

    <div class="container">
        <div class="hero">
            <h1>Welcome to our Vehicle Service Center</h1>
            <p>Your one-stop solution for all vehicle maintenance needs.</p>
        </div>

        <div class="services">
            <div class="service">
                <h3>Profile</h3>
                <a href="profile.php"><button>Account Information & My Profile</button></a>
            </div>
           
            <div class="service">
                <h3>Vehicel Details & Bill Generation</h3>
                <a href="vehicle.php"><button>View</button></a>
            </div>
            <button class="logout-button" onclick="confirmLogout()">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
            
            
        </div>
        <form id="logout-form" action="logout.php" method="post" style="display: none;">
        <!-- This form is hidden and will be submitted when the user confirms logout. -->
    </form>


        <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // If the user confirms, submit the logout form
                document.getElementById('logout-form').submit();
            } else {
                // If the user cancels, do nothing
            }
        }
    </script>
    </div>
    </div>

    <div class="footer">
        <p>&copy; 2023 Vehicle Service Management System. All rights reserved.</p>
    </div>
</body>

</html>