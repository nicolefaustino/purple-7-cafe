<?php
// Database credentials
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "reservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
$contactNumber = $_POST['contact-number'];
$facebookName = $_POST['facebook-name'];
$facebookLink = $_POST['facebook-link'];
$tables = $_POST['no-of-tables'];
$groupSize = $_POST['group-size'];
$timeslot = $_POST['timeslot'];
$paymentRef = $_POST['payment-ref'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO reservation_details (first_name, last_name, email, contact_number, facebook_name, facebook_link, tables, group_size, timeslot, payment_reference) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssisss", $firstName, $lastName, $email, $contactNumber, $facebookName, $facebookLink, $tables, $groupSize, $timeslot, $paymentRef);

// Execute the statement
if ($stmt->execute()) {
    echo "Reservation successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
