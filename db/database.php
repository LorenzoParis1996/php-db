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

//path to log file
$log_file = 'inserted_users.log';

//read existing entries from log file
$existing_entries = [];

if (file_exists($log_file)) {
    $existing_entries = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$users_data = [
    ['Alice', 'Johnson', 28, '1996-03-15'],
    ['Brian', 'Smith', 34, '1990-07-22'],
    ['Clara', 'Davis', 22, '2002-11-05'],
    ['David', 'Brown', 45, '1978-01-30'],
    ['Emma', 'Wilson', 31, '1993-09-12'],
    ['Frank', 'Miller', 29, '1995-05-20'],
    ['Grace', 'Taylor', 40, '1984-02-18'],
    ['Henry', 'Anderson', 27, '1997-08-25'],
    ['Isabella', 'Thomas', 36, '1988-04-10'],
    ['Jack', 'Jackson', 50, '1974-12-01']
];

foreach ($users_data as $user) {
    $full_name = $user[0] . '' . $user[1];

    if (!in_array($full_name, $existing_entries)) {
        $insert_statement = $conn->prepare("INSERT INTO users (firstname, lastname, age, birth_date) VALUES(?,?,?,?)");
        $insert_statement->bind_param("ssis", $user[0], $user[1], $user[2], $user[3]);

        if($insert_statement->execute()) {
            echo "Inserted: {$full_name}<br>";
            file_put_contents($log_file, $full_name . PHP_EOL, FILE_APPEND);
        } else {
            echo "Error inserting: {$full_name} - " . $insert_statement->error . "<br>";
        }

        $insert_statement->close();
  
    }  else {
        echo "Duplicate found: {$full_name}, not inserted.<br>";
    }
}

?>