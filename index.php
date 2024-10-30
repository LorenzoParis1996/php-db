<?php 
//Output buffering allows you to control how output is sent to the browser. By starting a buffer, you can include files and capture their output as a string instead of displaying it immediately. In this case, we used to not display echo statements from another file when including it.

ob_start();
include './db/database.php';

$output = ob_get_clean();

$db = "SELECT * FROM users";
$result = $conn->query($db);

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
            <h2>Entries</h2>
            <a href="./form.php">Add new record</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Age</th>
                    <th scope="col">Birth date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                <?php foreach($result as $user): ?>
                <tr>

                    <!-- The htmlspecialchars() function is used to convert special characters to HTML entities. This is a security measure to prevent XSS (Cross-Site Scripting) attacks by ensuring that any HTML tags or special characters in user data are displayed as plain text rather than being executed as HTML. -->

                    <td><?php echo htmlspecialchars($user["firstname"]); ?></td>
                    <td><?php echo htmlspecialchars($user["lastname"]); ?></td>
                    <td><?php echo htmlspecialchars($user["age"]); ?></td>
                    <td><?php echo htmlspecialchars($user["birth_date"]); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="4">No entries found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</body>

</html>