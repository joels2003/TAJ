<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service History</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Include your CSS file if needed -->

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }

        /* Apply styles to the <a> element */
        a.button {
            display: inline-block;
            padding: 10px 20px;
            /* Adjust padding as needed for button size */
            background-color: #007BFF;
            /* Button background color */
            color: #fff;
            /* Text color */
            text-decoration: none;
            /* Remove underline by default */
            border: none;
            /* Remove border */
            border-radius: 4px;
            /* Rounded corners */
            font-weight: bold;
            /* Make text bold */
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            /* Add a smooth transition on hover */
        }

        /* Style the button on hover */
        a.button:hover {
            background-color: #0056b3;
            /* Change background color on hover */
        }

        /* You can add more styles as needed, such as margin, box-shadow, etc. */


        button[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Service History</h1>
        <form action="service_history_action.php" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="vehicle_id">Vehicle ID:</label>
            <input type="text" id="vehicle_id" name="vehicle_id" required>

            <button type="submit" name="get_history">Get Service History</button>
            <a href="admin_dashboard.php" class="button">Back</a>
        </form>
    </div>
</body>

</html>