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

echo "Connection successful<br>";

//create db
$sql = "CREATE DATABASE IF NOT EXISTS myDB"; //IF NOT EXISTS is needed when working on already existing database, otherwise it will try to create a new db that already exists and throw errors.

if ($conn->query($sql) === true) {
    echo "Db creation successful<br>";
} else {
    echo "Error creating db: " . $conn->connect_error; 
}

//select db
$conn->select_db("myDB");

//create table
$users_table = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(40) NOT NULL,
    lastname VARCHAR(40) NOT NULL,
    age TINYINT UNSIGNED NOT NULL,
    birth_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($users_table) === true) {
    echo "Table creation successful<br>";
} else {
    echo "Error creating table: " . $conn->connect_error;
}

//insert data into table
$users_data = "INSERT INTO IF NOT EXISTS users (firstname, lastname, age, birth_date)
VALUES ('Alice', 'Johnson', 28, '1996-03-15');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Brian', 'Smith', 34, '1990-07-22');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Clara', 'Davis', 22, '2002-11-05');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('David', 'Brown', 45, '1978-01-30');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Emma', 'Wilson', 31, '1993-09-12');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Frank', 'Miller', 29, '1995-05-20');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Grace', 'Taylor', 40, '1984-02-18');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Henry', 'Anderson', 27, '1997-08-25');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Isabella', 'Thomas', 36, '1988-04-10');";
$users_data .= "INSERT INTO users (firstname, lastname, age, birth_date)
VALUES ('Jack', 'Jackson', 50, '1974-12-01');";

if ($conn->multi_query($users_data) === true) {
    echo "Records inserted successfully<br>";
} else {
    echo "Error inserting new records: " . $conn->connect_error;
}

?>