<?php
// Database configuration
$host = 'localhost';
$dbName = 'job_management_name_2024';
$username = 'job_management_username_2024';
$password = 'job_management_password_2024';

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbName);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a job
function addJob($first_name, $last_name, $email, $location, $description, $completed) {
    global $conn;
    
    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO jobs_table (first_name, last_name, email, location, description, completed) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $location, $description, $completed);
    
    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "New job added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Function to fetch all jobs
function fetchJobs() {
    global $conn;
    
    $sql = "SELECT * FROM jobs_table";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "First Name: " . $row["first_name"]. " - Last Name: " . $row["last_name"]. " - Email: " . $row["email"]. " - Location: " . $row["location"]. " - Description: " . $row["description"]. " - Completed: " . $row["completed"]. "<br>";
        }
    } else {
        echo "0 results";
    }
}

// Function to update a job's completion status
function updateJobCompletion($id, $completed) {
    global $conn;
    
    // Prepare an SQL statement
    $stmt = $conn->prepare("UPDATE jobs_table SET completed = ? WHERE id = ?");
    $stmt->bind_param("ii", $completed, $id);
    
    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Job updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Function to delete a job
function deleteJob($id) {
    global $conn;
    
    // Prepare an SQL statement
    $stmt = $conn->prepare("DELETE FROM jobs_table WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Job deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Example usage
// Uncomment the following lines to test the functions

// addJob('John', 'Doe', 'john.doe@example.com', 'New York', 'Fix the server', 0);
// fetchJobs();
// updateJobCompletion(1, 1);
// deleteJob(1);

// Close the connection
$conn->close();
?>
