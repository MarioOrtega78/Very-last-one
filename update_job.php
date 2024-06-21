<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Job</title>
    
    <style>
    body {
        font-family: tahoma;
        background-color: #eee;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        flex-direction: column;
    }
    input[type=submit], .return-button {
        font-size: 110%;
        background-color: green;
        color: white;
        border-radius: 4px;
        width: 25%; /* Reduced width */
        padding: 10px;
        border: none;
        display: block;
        margin: 10px auto;
        text-align: center;
        text-decoration: none; /* For the return button to look like a button */
    }
    select {
        width: 25%; /* Reduced width */
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: #fff;
        font-size: 110%;
        margin: 10px auto;
        border: 1px solid #333;
        display: block;
    }
    .container {
        width: 60%;
        max-width: 600px;
        margin-top: 20px;
    }
    .job-info {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }
    .header {
        background-color: #28a745;
        width: 100%;
        padding: 20px 0; /* Thicker green bar */
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }
    .header img {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        height: 60px; /* Bigger logo */
    }
    .header h1 {
        text-align: center;
        color: white;
        margin: 0;
        font-size: 24px;
    }
    .thin-bar {
        background-color: #218838; /* Darker shade of green for better visibility */
        height: 10px; /* Thinner bottom bar */
        width: 100%;
        position: absolute;
        top: 60px; /* Position it below the thick green bar */
        border: none; /* Remove white line */
    }
    .form-label {
        font-size: 110%;
        margin: 10px auto;
        text-align: center;
    }
    .message-box {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        margin: 20px 0;
    }
    </style>
</head>
<body>
    <div class="header">
        <img src="WVAlogo.svg" alt="Logo" height="60">
        <h1>Job Information</h1>
    </div>
    <div class="thin-bar"></div>
    <div class="container">
        <?php
            // Database connection variables for the new database
            $servername = "localhost";
            $username = "job_management_username_2024";
            $password = "job_management_password_2024";
            $database = "job_management_name_2024";

            try {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { // The update / submit button has been pressed
                    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); // Building a new connection object
                    // Set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $id = $_POST['id']; // The ID of the job we wanted to edit from the hidden form field
                    $completed = $_POST['completed']; // Completed status from $_POST

                    $sql = $conn->prepare("UPDATE jobs_table SET completed = ? WHERE id = ?");
                    $sql->bindValue(1, $completed); // Bind this variable to the first ? in the SQL statement
                    $sql->bindValue(2, $id); // Bind this value to the second ? in the SQL statement
                    
                    $sql->execute(); // Execute the statement

                    echo '<div class="message-box">Job updated</div>';
                    echo '<a href="technicianpage.html" class="return-button">Return to Technician Page</a>';
                } else {
                    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); // Building a new connection object
                    // Set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $id = $_GET['id']; // The ID of the job we want to edit from the URL
                    
                    $sql = $conn->prepare("SELECT * FROM jobs_table WHERE id = ?");
                    $sql->bindValue(1, $id); // Bind this variable to the first ? in the SQL statement

                    $sql->execute(); // Execute the statement

                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                    
                    // Pre-populate drop down logic
                    if ($row['completed'] == 'no') {
                        $no_completed = 'selected = "selected"';
                    } else {
                        $no_completed = '';
                    }

                    if ($row['completed'] == 'yes') {
                        $yes_completed = 'selected = "selected"';
                    } else {
                        $yes_completed = '';
                    }
                    
                    // Information about the job inside a box
                    echo '<div class="job-info">';
                    echo '<strong>ID:</strong> ' . htmlspecialchars($row['id']) . '<br>';
                    echo '<strong>First Name:</strong> ' . htmlspecialchars($row['first_name']) . '<br>';
                    echo '<strong>Last Name:</strong> ' . htmlspecialchars($row['last_name']) . '<br>';
                    echo '<strong>Email:</strong> ' . htmlspecialchars($row['email']) . '<br>';
                    echo '<strong>Location:</strong> ' . htmlspecialchars($row['location']) . '<br>';
                    echo '<strong>Description:</strong> ' . htmlspecialchars($row['description']) . '<br>';
                    echo '<strong>Completed:</strong> ' . htmlspecialchars($row['completed']) . '<br>';
                    echo '</div>';
                    
                    // Form for updating the job
                    echo '<form method="post">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<div class="form-label">Job Completion</div>';
                    echo '<select name="completed">';
                    echo '<option value="no" ' . $no_completed . '>No</option>';
                    echo '<option value="yes" ' . $yes_completed . '>Yes</option>';
                    echo '</select>';
                    echo '<input type="submit" value="Update">';
                    echo '</form>';
                }
            } catch (PDOException $e) {
                echo '<div class="message-box">' . $sql . "<br>" . $e->getMessage() . '</div>'; // If we are not successful in connecting or running the query we will see an error
                echo '<a href="technicianpage.html" class="return-button">Return to Technician Page</a>';
            }
        ?>
    </div>
</body>
</html>
