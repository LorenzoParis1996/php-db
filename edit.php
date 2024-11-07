<?php 
ob_start();
include './db/database.php';
$output = ob_get_clean();

$errors = [];

if(isset($_GET['id'])) {
    $userId = intval($_GET['id']);


    $db = "SELECT * FROM users WHERE id = ?";
    $statement = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($statement, $db)) {
        mysqli_stmt_bind_param($statement, "i", $userId);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        if ($user = mysqli_fetch_assoc($result)) {
             $firstname = $user['firstname'];
             $lastname = $user['lastname'];
             $age = $user['age'];
             $birth_date = $user['birth_date'];
        } else {
            echo "User not found";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $age = (int)$_POST['age']; 
    $birth_date = trim($_POST['birth_date']);

    if (empty($firstname) || empty($lastname) || empty($age) || empty($birth_date)) {
        $errors[] = "All fields required";
    }

    if (empty($errors)) {
        $userUpdate = "UPDATE users SET firstname=?, lastname=?, age=?, birth_date=? WHERE id=?";
        if ($statement = mysqli_prepare($conn, $userUpdate)) {
            mysqli_stmt_bind_param($statement, "ssisi", $firstname, $lastname, $age, $birth_date, $userId);
            mysqli_stmt_execute($statement);
            mysqli_stmt_close($statement);
            
            echo "Record updated successfully<br>";
            header("Location: index.php");
            exit;
        } else {
            echo "Error in updating record<br>";
        }
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
            <h2>Add new record</h2>
            <a href="./index.php">Back to entries</a>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name"
                        value="<?php echo htmlspecialchars($firstname ?? ''); ?>" required pattern="[A-Za-z\s]+"
                        title="Only letters and spaces allowed">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name"
                        value="<?php echo htmlspecialchars($lastname ?? ''); ?>" required pattern="[A-Za-z\s]+"
                        title="Only letters and spaces allowed">
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Age"
                        value="<?php echo htmlspecialchars($age ?? ''); ?>" required min="1" max="120">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Birth date</label>
                    <input type="date" class="form-control" id="date" name="birth_date"
                        value="<?php echo htmlspecialchars($birth_date ?? ''); ?>" placeholder="YYYY-MM-DD">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Update record</button>
            </form>
        </div>

    </section>

</body>

</html>