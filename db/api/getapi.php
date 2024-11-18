<?php 

ob_start();
include '../database.php';
$output = ob_get_clean();

$query = "SELECT * FROM users";
$result = $conn->query($query);

if ($result->num_rows > 0){

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    header('Content-Type: application/json');
    
    echo json_encode($data);
}