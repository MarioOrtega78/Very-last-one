<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Viewing the Jobs Table</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }
        .header img {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            height: 130px; /* Increased logo size */
        }
        .header .title {
            font-size: 36px; /* Increased message size */
            margin: 0;
            padding-bottom: 20px; /* Added space below the title */
        }
        .button-container {
            text-align: center;
            margin-top: 10px;
        }
        .button-container a {
            background-color: #218838;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .button-container a:hover {
            background-color: #1e7e34;
        }
        .sub-header {
            background-color: #218838;
            height: 20px;
        }
        table {
            width: 80%;
            margin: 40px auto; /* Centering the table and adding margin */
            border-collapse: collapse;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
            background: #fff;
            border: 1px solid #ddd; /* Adding border to the table */
            border-radius: 8px; /* Adding border radius */
            overflow: hidden; /* Ensuring border radius applies to table content */
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #28a745; /* Setting header row color */
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:last-child td {
            border-bottom: none;
        }
        a.button {
            padding: 5px;
            background-color: green;
            color: white;
            border-radius: 3px;
            margin-top: 3px;
            display: block;
            width: 130px;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="WVAlogo.svg" alt="Logo">
        <div class="title">Uncompleted Jobs</div>
        <div class="button-container">
            <a href="technicianpage.html">Return to Technician Page</a>
        </div>
    </div>
    <div class="sub-header"></div>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Location</th>
            <th>Description</th>
            <th>Completed</th>
            <th>Update</th>
        </tr>
    <?php
        // Database connection variables for the job management database
        $servername = "localhost";
        $username = "job_management_username_2024";
        $password = "job_management_password_2024";
        $database = "job_management_name_2024";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Selecting multiple rows from the jobs_table where completed is 'no'
            $sql = "SELECT * FROM jobs_table WHERE completed = 'no' ORDER BY id DESC LIMIT 50";

            foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['first_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['last_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['location']) . '</td>';
                echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                echo '<td>' . htmlspecialchars($row['completed']) . '</td>';
                echo '<td><a href="update_job.php?id=' . htmlspecialchars($row['id']) . '" class="button">Update this job</a></td>';
                echo '</tr>';
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='8'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
    ?>
    </table>
</body>
</html>
