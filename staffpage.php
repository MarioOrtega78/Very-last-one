<?php
$servername = "localhost";
$username = "job_management_username_2024";
$password = "job_management_password_2024";
$dbname = "job_management_name_2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO jobs_table (first_name, last_name, email, location, description, completed) VALUES (?, ?, ?, ?, ?, 'no')");
$stmt->bind_param("sssss", $first_name, $last_name, $email, $location, $description);

// Set parameters and execute
$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$email = htmlspecialchars($_POST['email']);
$location = htmlspecialchars($_POST['location']);
$description = htmlspecialchars($_POST['description']);

$message = "";

if ($stmt->execute()) {
    $message = "New record created successfully";
} else {
    $message = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #28a745;
            padding: 1px; /* Thinner top bar, about 1/5 of the previous thickness */
            position: relative;
        }
        .header img {
            height: 120px; /* Increase the height of the logo */
            vertical-align: middle;
            margin-left: 10px;
        }
        .thin-bar {
            background-color: #218838; /* Darker shade of green for better visibility */
            height: 10px; /* Thinner bottom bar */
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 24px; /* Smaller font size for the title */
        }
        p {
            font-size: 18px;
            text-align: center;
            color: #666;
        }
        .button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="WVAlogo.svg" alt="Logo">
    </div>
    <div class="thin-bar"></div>
    <div class="container">
        <p><?php echo $message; ?></p>
        <a href="staffpage.html" class="button">Return to Staff Page</a>
    </div>
</body>
</html>
