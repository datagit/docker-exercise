<?php
$servername = "c-mysql";
$username = "testuser1";
$password = "testpass1";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

phpinfo();