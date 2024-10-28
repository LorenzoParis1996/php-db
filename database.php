<?php 

$servername = "localhost";
$username = "root";
$password = "root";

//creates connection to db
$conn = new mysqli ($servername, $username, $password);

//checks if connection is successful or not
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful";

//create db
$sql = "CREATE DATABASE myDB";

if ($conn->query($sql) === true) {
    echo "Db creation successful";
} else {
    echo "Error creating db: " . $conn->connect_error; 
}

?>