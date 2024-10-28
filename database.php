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
$sql = "CREATE DATABASE IF NOT EXISTS myDB"; //IF NOT EXISTS is needed when working on already existing database, otherwise it will try to create a new db that already exists and throw errors.

if ($conn->query($sql) === true) {
    echo "Db creation successful";
} else {
    echo "Error creating db: " . $conn->connect_error; 
}

//select db
$conn->select_db("myDB");

//create table
$users_table = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(40) NOT NULL,
    lastname VARCHAR(40) NOT NULL,
    age TINYINT UNSIGNED NOT NULL,
    birth_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($users_table) === true) {
    echo "Table creation successful";
} else {
    echo "Error creating table: " . $conn->connect_error;
}

?>