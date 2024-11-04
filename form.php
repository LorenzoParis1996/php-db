<?php
 ob_start();
 include './db/database.php';
 $output = ob_get_clean();

 $errors = [];

 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $age = (int)$_POST['age']; 
    $birth_date = trim($_POST['birth_date']);

     echo "First Name: '$firstname'<br>";
     echo "Last Name: '$lastname'<br>";
     echo "Age: $age<br>";
     echo "Birth Date: '$birth_date'<br>";

    if (empty($firstname)){
        $errors[] = "First name required";
    } elseif (!preg_match("/^[A-Za-z\s]+$/", $firstname)) {
        $errors[] = "First name can only contain letters and spaces.";
    }
    
    if (empty($lastname)){
        $errors[] = "First name required";
    } elseif (!preg_match("/^[A-Za-z\s]+$/", $lastname)) {
        $errors[] = "First name can only contain letters and spaces.";
    }

    if ($age <= 0 || $age > 120) {
        $errors[] = "Enter a valid age";
    }

    if (empty($birth_date)) {
        $errors[] = "Birth date required";
    } else {
        $date = DateTime::createFromFormat('Y-m-d', $birth_date);
        if (!$date || $date->format('Y-m-d') !== $birth_date) {
            $errors[] = "Birth date must be in YYYY-MM-DD format";
        }
    }

    if (empty($errors)) {

        $insert_statement = $conn->prepare("
        INSERT INTO users (firstname, lastname, age, birth_date)
        VALUES (?, ?, ?, ?)");
    
        $insert_statement->bind_param("ssis", $firstname, $lastname, $age, $birth_date);
    
    
        if ($insert_statement->execute()) {
        echo "New record created successfully<br>";
        header("Location: index.php");
        exit;
        } else {
        echo "Error: " . htmlspecialchars($insert_statement->error) . "<br>";
        }
    
    
        $insert_statement->close();
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
            <form action="form.php" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">First name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="firstname"
                        placeholder="First name" value="<?php echo htmlspecialchars($firstname ?? ''); ?>" required pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" name="lastname"
                        placeholder="Last name" value="<?php echo htmlspecialchars($lastname ?? ''); ?>" required pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Age</label>
                    <input type="number" class="form-control" id="exampleFormControlInput3" name="age"
                        placeholder="Age" value="<?php echo htmlspecialchars($age ?? ''); ?>" required min="1" max="120">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Birth date</label>
                    <input type="date" class="form-control" id="exampleFormControlInput4" name="birth_date"
                    value="<?php echo htmlspecialchars($birth_date ?? ''); ?>" placeholder="YYYY-MM-DD">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Add new record</button>
            </form>
        </div>

    </section>

</body>

</html>