<?php 
ob_start();
include './db/database.php';
$output = ob_get_clean();

if(isset($_GET['id'])) {
    $userId = intval($_GET['id']);


    $db = "SELECT * FROM users WHERE id = ?";
    $statement = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($statement, $db)) {
        mysqli_stmt_bind_param($statement, "i", $userId);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
    }

    if ($user = mysqli_fetch_assoc($result)) {

    } else {
        echo "User not found";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <section class="container">
        <div class="d-flex justify-content-between">
            <h2>User details</h2>
            <a href="./index.php">Back to entries</a>
        </div>
        <div>
            <p>Firtsname: <?php echo htmlspecialchars($user['firstname']) ?></p>
            <p>Lastname: <?php echo htmlspecialchars($user['lastname']) ?></p>
            <p>Age: <?php echo htmlspecialchars($user['age']) ?></p>
            <p>Birth date: <?php echo htmlspecialchars($user['birth_date']) ?></p>
        </div>
    </section>
</body>

</html>