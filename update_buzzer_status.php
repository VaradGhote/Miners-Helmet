<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EDI";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update buzzer_status to 1
$sql = "UPDATE employee SET Buzzer_Status = 1";
if ($conn->query($sql) === TRUE) {
    echo "Buzzer status updated successfully";
} else {
    echo "Error updating buzzer status: " . $conn->error;
}

$conn->close();
?>
